<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateurs;
use App\Repository\RessourcesRepository;

class HomeController extends AbstractController
{
    // Point d'entrée de l'application associé à un nom pour utilisation dans les chemins 
    #[Route('/', name: 'app_home')]
    public function index(RessourcesRepository $repository): Response
    {
    //Récuperation de toutes les ressources en bdd et envoies dans le fichier twig (vue)
        return $this->render('home/index.html.twig', [
            'ressources' => $repository->findAll(),          
        ]);
    }
}
