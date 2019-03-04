<?php

namespace App\DataFixtures;

use App\Entity\Student;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class StudentFixtures extends BaseFixtures implements DependentFixtureInterface
{
    const CIVILITY = [
        'M',
        'Mme',
    ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Student::class, 50, function (Student $student, $count) {
            $student->setCountry($this->faker->country)
                ->setCity($this->faker->city)
                ->setZipcode($this->faker->postcode)
                ->setAddress1($this->faker->address)
                ->setPhone($this->faker->phoneNumber)
                ->setBirthdate($this->faker->unique()->dateTimeBetween('-45 years', '-16 years'))
                ->setIne($this->faker->randomNumber(9) . $this->faker->regexify('[A-Z]{2}'))
                ->setLastname($this->faker->lastName)
                ->setCivility($this->faker->randomElement(self::CIVILITY));
            if ($student->getCivility() === 'M') {
                $student->setFirstname($this->faker->firstNameMale);
            } else {
                $student->setFirstname($this->faker->firstNameFemale);
            }
            for ($j = 0; $j < 5; $j++) {
                $student->addSkill($this->getReference('skill_' . mt_rand(0, 550)));
            }
            $Usercount = $count + 50;
            $student->setUser($this->getReference(User::class . '_' . $Usercount));
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
