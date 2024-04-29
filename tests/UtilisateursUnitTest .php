<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Utilisateurs;

class UtilisateursUnitTest extends TestCase
{

//Test Unitaire Utilisateurs


// Ajout d'information valide 
    public function testValide()
    {
    $Utilisateurs = new Utilisateurs();

    $Utilisateurs->setUsrPrenom('prenom')
                 ->setUsrNom('nom')
                 ->setEmail('true@test.com')
                 ->setPassword('password');

     $this->assertTrue($Utilisateurs->getUsrPrenom() === 'prenom');
     $this->assertTrue($Utilisateurs->getUsrNom() === 'nom');
     $this->assertTrue($Utilisateurs->getEmail() === 'true@test.com');
     $this->assertTrue($Utilisateurs->getPassword() === 'password');
}

//Ajout de fausse information
public function testFaux()
{
    $Utilisateurs = new Utilisateurs();

  $Utilisateurs->setUsrPrenom('prenom')
               ->setUsrNom('nom')
               ->setEmail('true@test.com')
               ->setPassword('password');


     $this->assertFalse($Utilisateurs->getUsrPrenom() === 'false');
     $this->assertFalse($Utilisateurs->getUsrNom() === 'false');
     $this->assertFalse($Utilisateurs->getEmail() === 'false@test.com');
     $this->assertFalse($Utilisateurs->getPassword() === 'false');
}


// Validation du bouton avec des champs vides
public function testChampVide()
{
    $Utilisateurs = new Utilisateurs();

     $this->assertEmpty($Utilisateurs->getUsrPrenom());
     $this->assertEmpty($Utilisateurs->getUsrNom());
     $this->assertEmpty($Utilisateurs->getEmail());
}
}




