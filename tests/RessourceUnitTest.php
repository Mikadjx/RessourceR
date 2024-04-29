<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Ressources;

class RessourceUnitTest extends TestCase
{

//Test Unitaire Ressource

public function testValide()
{
$Ressources = new Ressources();
$Ressources->setResTitre('titre')
           ->setResContent('content')
           ->setResType('type')
           ->setResPath('path')
           ->setResEtiquette('etiquette');

           $this->assertTrue($Ressources->getResTitre() === 'titre');
           $this->assertTrue($Ressources->getResContent() === 'content'); 
           $this->assertTrue($Ressources->getResType() === 'type');
           $this->assertTrue($Ressources->getResPath() === 'path');
           $this->assertTrue($Ressources->getResEtiquette() === 'etiquette');
}

public function testFaux()
{
$Ressources = new Ressources();

$Ressources->setResTitre('titre')
           ->setResContent('content')
           ->setResType('type')
           ->setResPath('path')
           ->setResEtiquette('etiquette');

 $this->assertFalse($Ressources->getResTitre() === 'false');
 $this->assertFalse($Ressources->getResContent() === 'false');
 $this->assertFalse($Ressources->getResType() === 'false');
 $this->assertFalse($Ressources->getResPath() === 'false');
 $this->assertFalse($Ressources->getResEtiquette() === 'false');

}

public function testChampVide()
{
$Ressources = new Ressources();

$this->assertEmpty($Ressources->getResTitre());
$this->assertEmpty($Ressources->getResContent());
$this->assertEmpty($Ressources->getResType());
$this->assertEmpty($Ressources->getResPath());
$this->assertEmpty($Ressources->getResEtiquette());
}
}