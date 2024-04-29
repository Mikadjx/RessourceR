<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\UtilisateursCrudController;
use App\Entity\Utilisateurs;
use App\Entity\Ressources;
use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]

    // Appel de fonction lors de l'accès à la page Admin 
    public function index(): Response
    {
    // Redirection automatique vers le contrôleur de l'utilisateur qui gère l'interface d'administration
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
    return $this->redirect($adminUrlGenerator->setController(UtilisateursCrudController::class)->generateUrl());
    }

    // Configuration du Dashboard
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('Ressource Relationnelle- Administration');
    
    }

    // Configuration de la side bar du dashboard en récupérant les classes du dossier entity
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToRoute('Accueil ressource relationnelle', 'fas fa-user-circle', 'app_ressource');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateurs::class);
        yield MenuItem::linkToCrud('Ressources', 'fa-solid fa-book', Ressources::class);
        yield MenuItem::linkToCrud('Catégories', 'fa-solid fa-list', Categories::class);
    }

}
