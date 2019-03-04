<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use App\Entity\Student;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ExperienceFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Experience::class, 50, function (Experience $experience, $count) {
            $experience->setName($this->faker->word)
                ->setDescription($this->faker->realText(50))
                ->setCompanyBrand($this->faker->company)
                ->setBeginDate($this->faker->dateTimeBetween('-5 years', '-1 years'))
                ->setEndDate($this->faker->dateTimeBetween('-4 years', 'now'))
                ->setPlace($this->faker->country);
            $experience->setStudent($this->getReference(Student::class . '_' . $count));
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
