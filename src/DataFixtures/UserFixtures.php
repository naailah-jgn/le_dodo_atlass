<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Generator;
use Faker\Factory;

class UserFixtures extends Fixture 
{
    public const NB_USER = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($userId = 0; $userId < self::NB_USER; $userId++) {
            $user = new User();
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();
            $user->setFirstname($firstName);
            $user->setLastname($lastName);
            $user->setEmail($faker->email());
            $user->setPhoneNumber($faker->phoneNumber());
            $user->setRoles(['ROLE_USER']);
            $user->setAddress($faker->streetAddress());
            $user->setZipCode($faker->postcode());
            $user->setCity($faker->city());
            $user->setPlainPassword('password');

            if (!$userId) {
                $user->setemail('admin@gmail.com');
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setemail($firstName . '.' . $lastName . '@gmail.com');
                $user->setRoles(['ROLE_USER']);
            }
            $this->addReference('user_' . $userId, $user);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
