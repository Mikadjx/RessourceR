<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    // Formulaire de connexion 

    #[Route(path: '/login', name: 'app_login', methods:['POST'])]
    public function login(AuthenticationUtils $authenticationUtils): JsonResponse
    {
    //    Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
    //     if ($this->getUser()) {
    //     return $this->redirectToRoute('app_home');
    //     }

        // Obtenir l'erreur de connexion s'il y en a une.
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->json( ['last_username' => $lastUsername, 'error' => $error]);
    }
    //Deconnexion 
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
