<?php
/**
 * Created by PhpStorm.
 * User: Damien-trqr
 * Date: 10/01/19
 * Time: 11:09
 */

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Offer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OfferFixtures extends BaseFixtures implements DependentFixtureInterface
{

    const JOB = [
        'Développeur Web',
        'Architecte Base de données',
        'CTO',
        'Ingénieur d\'affaires',
        'Testeur',
        'Ingénieur réseau',
        'Lead Tech.',
        'Data analyst',
    ];

    const JOBDOMAIN = [
        'Développement logiciel',
        'BigData',
        'Reseaux & serveurs',
        'Digitalisation des entreprises',
        'Communication',
    ];

    const TYPE = [
        'Stage',
        'Alternance',
    ];

    const DRIVING = ['A','B','C',null ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Offer::class, 50, function (Offer $offer, $count) {
            $offer->setJob($this->faker->randomElement(self::JOB))
                ->setTitle('Recherche ' . $offer->getJob() . ' H/F')
                ->setDescription($this->faker->text(500))
                ->setType($this->faker->randomElement(self::TYPE))
                ->setBegin($this->faker->dateTimeBetween('+2 months', '+ 1 years'))
                ->setJobDomain($this->faker->randomElement(self::JOBDOMAIN))
                ->setTutor($this->faker->name)
                ->setDrivingLicence($this->faker->randomElement(self::DRIVING))
                ->setSalary($this->faker->numberBetween($min = 577, $max = 1466));
            if ($offer->getType() === 'Stage') {
                $offer->setDuration($this->faker->numberBetween(1, 6) . ' mois');
            } else {
                $offer->setDuration($this->faker->numberBetween(1, 2) . ' année(s)');
            }
            $offer->setCompany($this->getReference(Company::class . '_' .$count));
            if (($count % parent::BATCH_MAX_SIZE) === 0) {
                $this->manager->persist($offer);
                $this->manager->flush();
                $this->manager->clear();
            }
        });
        $manager->flush();
        $manager->clear();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [CompanyFixtures::class];
    }
}
