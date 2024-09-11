<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un admin
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstName('AdminFirstName');
        $admin->setLastName('AdminLastName');
        $admin->setAddress('123 Admin Street');
        $admin->setCity('AdminCity');
        $admin->setCountry('AdminCountry');
        $admin->setBirthDate(new \DateTime('1980-01-01')); // Date de naissance fictive
        $admin->setGender('male'); // Valeur ajoutée pour le champ 'gender'
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        // Création d'un utilisateur standard
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setFirstName('UserFirstName');
        $user->setLastName('UserLastName');
        $user->setAddress('456 User Avenue');
        $user->setCity('UserCity');
        $user->setCountry('UserCountry');
        $user->setBirthDate(new \DateTime('1990-01-01')); // Date de naissance fictive
        $user->setGender('female'); // Valeur ajoutée pour le champ 'gender'
        // ROLE_USER est défini par défaut dans l'entité User
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'userpassword');
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        // Sauvegarder les deux utilisateurs en base de données
        $manager->flush();
    }
}
