<?php
/**
 * Created by PhpStorm.
 * User: Damien-trqr
 * Date: 10/01/19
 * Time: 15:33
 */

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CompanyFixtures extends BaseFixtures implements DependentFixtureInterface
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Company::class, 50, function (Company $company, $count) {

            $company->setName($this->faker->company)
                ->setDescription($this->faker->paragraph(3))
                ->setSiret($this->faker->siret)
                ->setPhone($this->faker->phoneNumber)
                ->setAddress1($this->faker->streetAddress)
                ->setZipcode($this->faker->postcode)
                ->setCity($this->faker->city)
                ->setType($this->faker->randomElement(OfferFixtures::JOBDOMAIN))
                ->setEmail($this->faker->email)
                //->setEmail('plop@gmail.com')
                ->setCountry($this->faker->country)
                ->setUser($this->getReference(User::class . '_' . $count));
            if (($count % parent::BATCH_MAX_SIZE) === 0) {
                $this->manager->persist($company);
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
        return [UserFixtures::class];
    }
}
