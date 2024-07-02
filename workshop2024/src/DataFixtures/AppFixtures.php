<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Peinture;
use App\Entity\Vente;
use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Create a sample admin user
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpassword'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('admin@example.com');
        $manager->persist($admin);

        // Create a sample regular user
        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'userpassword'));
        $user->setRoles(['ROLE_USER']);
        $user->setEmail('user@example.com');
        $manager->persist($user);


        // Flush to save all entities in the database
        $manager->flush();
    }
}
