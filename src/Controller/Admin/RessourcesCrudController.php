<?php

namespace App\Controller\Admin;

use App\Entity\Ressources;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class RessourcesCrudController extends AbstractCrudController
{
    
    // Fonction permettant d'associé le contrôleur à l'entité 
    public static function getEntityFqcn(): string
    {
        return Ressources::class;
    }

    // Permet la modification visuel des attributs du tableau de l'entité "Ressources"
    public function configureFields(string $pageName): iterable
    {
        return [
        IdField::new('id')
        ->hideOnForm(), // Cacher la partie ID
        TextField::new('res_titre', 'Titre'),
        ImageField::new('imageName', 'Image')
        ->setBasePath('/uploads/images') // Le préfixe URI défini dans vich_uploader.yaml
        ->setUploadDir('public/uploads/images')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false),
        TextEditorField::new('res_content', 'Contenu'),
        ];
    }

}
