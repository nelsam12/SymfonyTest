<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enums\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    // Chiffre le mot de passe
    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    public function load(ObjectManager $manager): void
    {
        // Ajout d'un admin
        $user = new User();
        $user->setLogin('admin');
        $user->setPassword($this->hashPassword("1234"));
        $user->addRole(Role::ADMIN->value);
        $user->setNom('Admin');
        $user->setPrenom('Admin');
        $user->setEmail('admin@example.com');
        $manager->persist($user);

        // Ajout d'un boutiquier
        $user1 = new User();
        $user1->setLogin('boutiquier');
        $user1->setPassword($this->hashPassword("1234"));
        $user1->addRole(Role::BOUTIQUIER->value);
        $user1->setNom('Boutique');
        $user1->setPrenom('Boutique');
        $user1->setEmail('boutique@example.com');
        $manager->persist($user1);

        // Ajout d'un client
        $user2 = new User();
        $user2->setLogin('client');
        $user2->setPassword($this->hashPassword("1234"));
        $user2->addRole(Role::CLIENT->value);
        $user2->setNom('Client');
        $user2->setPrenom('Client');
        $user2->setEmail('client@example.com');
        $manager->persist($user2);

        // Enregistrement des données dans la base de données
        $manager->flush();
    }
}
