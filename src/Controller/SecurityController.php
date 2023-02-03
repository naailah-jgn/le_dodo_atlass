<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connection', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
       
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', name: 'security.logout')]
    public function logout()
    {

    }

    #[Route('/inscription', name: 'security.registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, UserRepository $userRepo): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $user = $form->getData();
                $userRepo->save($user, true);
                $this->addFlash('success', 'Votre compte a bien été crée!');
                return $this->redirectToRoute('/');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenu lors de la création de votre compte.');
            }
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
