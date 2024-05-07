<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RessourcesRepository;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods:['GET'])]
    public function index(RessourcesRepository $ressourceRepository, SerializerInterface $serializer)
    {
        // Récupération de toutes les ressources en BDD
        $ressources = $ressourceRepository->findAll();

        // Sérialisation des ressources avec le groupe 'ressources:read'
        $data = $serializer->serialize($ressources, 'json', ['groups' => 'ressources:read']);

        // Retourne les ressources sérialisées au format JSON
        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }
}     
