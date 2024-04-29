<?php

namespace App\Form;

use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('com_content', TextareaType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Ecrivez un commentaire...',
                    // Ajout du bouton avec l'icône de message dans le champ de formulaire
                    'prefix' => '<button type="submit" class="button_submit"><i class="fas fa-paper-plane custom-icon"></i></button>'
                ]
            ])
            // ->add('com_datePublication')
            // ->add('com_statutValidation')
            // ->add('com_ressources')
            // ->add('utilisateurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaires::class,
        ]);
    }
}
