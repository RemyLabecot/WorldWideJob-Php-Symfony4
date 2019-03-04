<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use App\Entity\Student;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FormationFixtures extends BaseFixtures implements DependentFixtureInterface
{
    const DOMAIN = [
        'Développement web',
        'Administration systèmes',
        'Recherche & développement',
        'Finance',
        'Éducation & formation',
        'Communication & publicité'
    ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Formation::class, 50, function (Formation $formation, $count) {
            $formation->setFormationName($this->faker->word)
                ->setDomain($this->faker->randomElement(self::DOMAIN))
                ->setDiploma($formation->getDomain())
                ->setDescription($this->faker->realText(50))
                ->setBeginDate($this->faker->dateTimeBetween('-5 years', '-1 years'))
                ->setEndDate($this->faker->dateTimeBetween('-4 years', 'now'))
                ->setStudent($this->getReference(Student::class . '_' . $count));
        });
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [StudentFixtures::class];
    }
}
