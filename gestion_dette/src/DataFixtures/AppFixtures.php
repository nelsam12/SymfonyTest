<?php

namespace App\DataFixtures;

use App\Enums\Role;
use App\Entity\User;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client->setSurnom('John_Doe');
        $client->setTelephone('771001010');
        $client->setAdresse('Adresse');
        // Compte au client
        $user = new User();
        $user->setLogin('johin');
        $user->setPassword($this->hashPassword("passer"));
        $user->addRole(Role::ADMIN->value);
        $user->addRole(Role::CLIENT->value);
        $user->addRole(Role::BOUTIQUIER->value);
        $user->setNom('Doe');
        $user->setPrenom('Joe');
        $user->setEmail('john@doe.com');
        $client->setCompte($user);
        $manager->persist($client);

        $manager->flush();
    }
}
