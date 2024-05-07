<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Security\LoginFormulaireAuthAuthenticator;


class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
 //Route pour la page inscription -> Injection d'un sysème d'authentification sécurisée

    #[Route('register', name: 'app_register',methods:["POST"])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher ,EntityManagerInterface $entityManager): JsonResponse
    {

        $user = new Utilisateurs();
        $user ->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                  // Encoder le mot de passe en clair
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // générer une URL signée et l'envoyer par e-mail à l'utilisateur pour la confirmation (inscription)
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@ressourceR.com', 'no-reply'))
                    ->to($user->getEmail())
                    ->subject('Confirmer votre adresse email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
                    ->context([
                        'prenom' => $user->getUsrPrenom(),
                        'nom' => $user->getUsrNom(),]));  
        return $this->redirectToRoute('app_home');
                    }

        return $this->json( [
            'registrationForm' => $form->createView(),
        ]);
    }
//Fonction pour veirifier l'identité de l'utilisateur par mail 
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

         //valider le lien de confirmation par e-mail, définir User::isVerified=true et persister
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // Modifier la redirection en cas de succès et gérer ou supprimer le message flash du templates
        $this->addFlash('success', 'Votre email a été vérifier!');
        //Redirection vers la page d'accueil en récupérant le nom de la route ("name" dans le controleur)
        return $this->redirectToRoute('app_login');
    }
}
