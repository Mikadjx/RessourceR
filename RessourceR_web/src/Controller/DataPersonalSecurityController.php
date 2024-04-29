<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataPersonalSecurityController extends AbstractController
{
    #[Route('/data/personal/security', name: 'app_data_personal_security')]
    public function index(): Response
    {
        return $this->render('data_personal_security/index.html.twig', [
            'controller_name' => 'DataPersonalSecurityController',
        ]);
    }
}
