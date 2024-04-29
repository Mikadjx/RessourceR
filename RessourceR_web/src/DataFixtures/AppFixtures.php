<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateurs;
use Faker\Generator;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

     public function __construct(private readonly UserPasswordHasherInterface $hasher)
     {

     }
 
//Commande pour ajout de fixture : symfony console doctrine:fixtures:load -> ATTENTION SUPPRESSION DES DONNEES !!

    public function load(ObjectManager $manager): void
    {
        $admin = (new Utilisateurs());
        $admin->setUsrPrenom('Dijoux');
        $admin ->setUsrNom('Mickael');
        $admin ->setEmail('test2@gmail.com');
        $admin->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $password = $this->hasher->hashPassword($admin,'Abcdef123456***');
        $admin ->setPassword($password);   
        $admin ->setIsVerified(false);
        $manager->persist($admin);
        $manager->flush();
    }
}  
