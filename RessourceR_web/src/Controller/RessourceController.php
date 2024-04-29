<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Commentaires;
use App\Entity\Ressources;
use App\Entity\Utilisateurs;
use App\Form\CommentaireFormType;
use App\Form\RessourceFormType;
use App\Repository\RessourcesRepository;
use App\Repository\CommentairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RessourceController extends AbstractController
{

    #[Route('/ressources', name: 'app_ressource')]
    public function index(RessourcesRepository $repository): Response
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
        return $this->render('ressource/index.html.twig', [
            'nom' => $nom,
            'prenom' => $prenom,
            'ressources' => $repository->findAll()         
        ]);
    }

//CRUD 

    // Requête permettant de crée une ressource 
    #[Route('/create/ressource', name: 'app_create_ressource')]
    public function Create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ressource = new Ressources();

        $form = $this->createForm(RessourceFormType::class, $ressource);
        $form->handleRequest($request);
    // Si le formulaire est valide malgré les contraintes et s'il a été soumis mettre à jour la date et instancier la classe ressource
        if ($form->isSubmitted() && $form->isValid())
        {
            date_default_timezone_set('Europe/Paris');
            $dateToday = date('Y-m-d H:i:s', getdate()["0"]);

            $ressource->setResDateCreation(new \DateTimeImmutable($dateToday));

            $entityManager->getRepository(Ressources::class)->save($ressource, true);
        //Redirection vers la page ressource
            return $this->redirectToRoute('app_ressource'); 
        }
        // Envoies de la vue du formulaire à l'éxecution de la page ressource 
        return $this->render('ressource/CreateRessource.html.twig', ['ressource_form' => $form->createView()]);
    }

    // Permet d'afficher une seul ressource en récupérant l'id (fonction find)

    #[Route('/ressource/{id}', name: 'app_show_ressource')]
    public function Show(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $ressource = $entityManager->getRepository(Ressources::class)->find($id);
        // Gestion d'erreur s'il n y aucune ressource
        if (!$ressource) {
            throw $this->createNotFoundException(
            "Aucune Ressource n'existe"
            );
        return new Response("Aucune Ressource n'existe");
        }

        $commentaire = new Commentaires();

        $form = $this->createForm(CommentaireFormType::class, $commentaire);
        $form->handleRequest($request);
    // Formulaire pour les commentaires
        if ($form->isSubmitted() && $form->isValid())
        {
            date_default_timezone_set('Europe/Paris');
            $dateToday = date('Y-m-d H:i:s', getdate()["0"]);
            $commentaire->setComDatePublication(new \DateTimeImmutable($dateToday));

            $commentaire->setComStatutValidation(1);
            $commentaire->setComRessources($ressource);

            $entityManager->getRepository(Commentaires::class)->save($commentaire, true);

            return $this->redirect($request->getUri());

        }
        //Lors de l'éxecution de la route ressource , affiche le formulaire de commentaire
        return $this->render('ressource/ShowRessource.html.twig', ['ressource' => $ressource, 'commentaire_form' => $form->createView()]);
    }
}

