<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateurs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UtilisateursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateurs::class;
    }

    //Permet la configuration des fonctionnalités CRUD pour le contrôleur
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Utilisateurs')
        ->setEntityLabelInSingular('Utilisateur')
        ->setPageTitle("index","Ressources relationnelles - administration des utilisateurs")
        ->setPaginatorPageSize(10);
    
    }
//Permet la Configuration des boutons d'action Supprimer/Modifier/Voir du tableau

// public function configureActions(Actions $actions): Actions
// {
//     return $actions
//         ->add(Crud::PAGE_INDEX, Action::DETAIL)
//             ->setIcon('fa fa-eye')
//         ->add(Crud::PAGE_INDEX, Action::EDIT)
//             ->setIcon('fa fa-pencil')
//         ->add(Crud::PAGE_INDEX, Action::DELETE)
//             ->setIcon('fa fa-trash');
// }

// Permet la modification visuel des attributs du tableau de l'entité "Ressources"
public function configureFields(string $pageName): iterable
    {
        return [

        IdField::new('id')
        ->hideOnForm(), // Cacher la partie ID
        TextField::new('usr_nom','Nom'),
        TextField::new('usr_prenom','Prénom'),
        TextField::new('email'),
        ArrayField::new('roles')
    ];
}

}
