<?php

namespace App\Form;

use App\Entity\Ressources;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RessourceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('res_titre', TextType::class, ['label' => 'Titre'])
            // ->add('categories', TextType::class, ['label' => 'Type de Catégories'])
            ->add('imageFile', FileType::class, ['label' => 'Charger une Image'])
            ->add('res_content', TextareaType::class, ['label' => 'Contenu'])
            ->add('Submit', SubmitType::class, ['label' => 'PUBLIER'])
            // ->add('res_dateCreation', DateType::class, ['label' => 'Date de création'])
            // ->add('res_estExploitee')
            // ->add('res_estRestrictif')
            // ->add('res_etiquette')
            // ->add('res_type')
            // ->add('tags')
            // ->add('utilisateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }
}
