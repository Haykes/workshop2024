<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        // Create some clients
        $client1 = new Client();
        $client1->setFirstname('John');
        $client1->setLastname('Doe');
        $client1->setAdresse('123 Main St');
        $client1->setComplement('Apt 4B');
        $client1->setTown('Paris');
        $client1->setPostalCode('75001');
        $client1->setEmail('john.doe@example.com');
        $client1->setPhone('0123456789');
        $client1->setCreatedAt(new \DateTime());
        $client1->setUpdatedAt(new \DateTime());
        $manager->persist($client1);

        $client2 = new Client();
        $client2->setFirstname('Jane');
        $client2->setLastname('Doe');
        $client2->setAdresse('456 Elm St');
        $client2->setComplement('Suite 1A');
        $client2->setTown('Lyon');
        $client2->setPostalCode('69001');
        $client2->setEmail('jane.doe@example.com');
        $client2->setPhone('0987654321');
        $client2->setCreatedAt(new \DateTime());
        $client2->setUpdatedAt(new \DateTime());
        $manager->persist($client2);

        // Create a sample admin user
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpassword'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('admin@example.com');
        $admin->setClient($client1);
        $manager->persist($admin);

        // Create a sample regular user
        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'userpassword'));
        $user->setRoles(['ROLE_USER']);
        $user->setEmail('user@example.com');
        $user->setClient($client2);
        $manager->persist($user);

        // Flush to save all entities in the database
        $manager->flush();
    }
}
