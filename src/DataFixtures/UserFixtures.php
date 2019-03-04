<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{
    private $passwordEncoder;

    private $roles = [
        'ROLE_STUDENT',
        'ROLE_COMPANY',
        'ROLE_SCHOOL',
        'ROLE_ADMIN',
    ];

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 150, function (User $user, $count) {
            if ($count < 50) {
                $user->setEmail($this->faker->email)
                    ->setRoles(['ROLE_COMPANY'])
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'wilder'));
            } elseif ($count < 100) {
                $user->setEmail($this->faker->email)
                    ->setRoles(['ROLE_STUDENT'])
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'wilder'));
            } else {
                $user->setEmail($this->faker->email)
                    ->setRoles(['ROLE_SCHOOL'])
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'wilder'));
            }
        });
        $manager->flush();
    }
}
