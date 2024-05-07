<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLegalesController extends AbstractController
{
    #[Route('mentions/legales', name: 'app_mentions_legales')]
    public function index(): JsonResponse
    {
        return $this->json([
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
