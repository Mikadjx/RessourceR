<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FavorisController extends AbstractController
{
    #[Route('add/favoris', name: 'add_favoris')]
    public function AddFavoris(): void
    {
        $test = ['un', 'deux', 'trois'];
        var_dump($test);
    }
}
