<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('usr_nom', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('usr_prenom', TextType::class, [
                'label' => 'Prenom'
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre adresse email.'
                    ]),
                    new Email([
                        'message' => 'L\'adresse email saisie n\'est pas valide.'
                    ]),
                ],
                'label' => 'Email'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                
                'label' => 'J\'accepte les conditions d\'utilisation',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions générales afin d\'être inscrit(e) sur le site',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
           //Encodage du mot de passe 
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'nouveau mot de passe'],
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/', 
                "Il faut un mot de passe de 14 caractères avec une majuscule, une minuscule, un chiffre et un caractère spécial") 
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
