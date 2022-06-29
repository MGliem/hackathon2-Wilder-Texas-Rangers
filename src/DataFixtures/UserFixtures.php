<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{


    
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {



        $faker = Factory::create();
        for ($i = 0; $i < 3; $i++) {
            $user = new User;
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'azerty'
            );
            $user->setPassword($hashedPassword);
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setSkills(['Smart', 'Punctual', 'Strong']);
            $user->setAgency($faker->city());
            $user->setBio($faker->paragraph());
            $user->setPhoto('assets/image/photo.jpg');
            $user->setPoints($faker->numberBetween(1, 200));

            $manager->persist($user);
        }

        $manager->flush();
    }
}