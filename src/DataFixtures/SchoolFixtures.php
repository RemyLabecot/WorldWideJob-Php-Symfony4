<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SchoolFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(School::class, 50, function (School $school, $count) {
            $school->setName($this->faker->userName)
                ->setDescription($this->faker->realText(50))
                ->setPhone($this->faker->phoneNumber)
                ->setAddress1($this->faker->address)
                ->setZipcode($this->faker->postcode)
                ->setCity($this->faker->city)
                ->setCountry($this->faker->country)
                ->setSiret($this->faker->siret)
                ->setEmail($this->faker->email);
            $user_count = $count + 100;
            $school->setUser($this->getReference(User::class . '_' . $user_count));
        });
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
