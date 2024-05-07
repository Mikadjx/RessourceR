<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\RessourcesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RessourceFormType;
use App\Entity\Ressources;

class RessourceController extends AbstractController
{
    #[Route('/api/ressources', name: 'app_ressource', methods: ['GET'])]

    public function index(RessourcesRepository $repository): JsonResponse
    {
        // Récupération des données utilisateurs pour les afficher
        $utilisateur = $this->getUser();
        $nom = '';
        $prenom = '';

        // Vérifiez si l'utilisateur est connecté et récupérez son nom et prénom s'il l'est
        if ($utilisateur instanceof Utilisateurs) {
            $nom = $utilisateur->getUsrNom();
            $prenom = $utilisateur->getUsrPrenom();
        }

        // Envoie des variables nom / prenom / ressource vers la vue
        return $this->json([
            'nom' => $nom,
            'prenom' => $prenom,
            'ressources' => $repository->findAll()
        ]);
    }

    //CRUD 

    // Requête permettant de créer une ressource
    #[Route('/create/ressource', name: 'app_create_ressource', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $ressource = new Ressources();

        $form = $this->createForm(RessourceFormType::class, $ressource);
        $form->handleRequest($request);

        // Si le formulaire est valide malgré les contraintes et s'il a été soumis mettre à jour la date et instancier la classe ressource
        if ($form->isSubmitted() && $form->isValid()) {
            date_default_timezone_set('Europe/Paris');
            $dateToday = date('Y-m-d H:i:s', getdate()["0"]);

            $ressource->setResDateCreation(new \DateTimeImmutable($dateToday));

            $entityManager->persist($ressource);
            $entityManager->flush();

            //Redirection vers la page ressource
            return $this->redirectToRoute('app_ressource');
        }

        // Envoies de la vue du formulaire à l'exécution de la page ressource 
        return $this->json(['ressource_form' => $form->createView()]);
    }
}
