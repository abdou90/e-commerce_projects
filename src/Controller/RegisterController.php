<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user =new User();
        // Création du formulaire
        $form = $this->createForm(RegisterUserType::class,$user);

        // Traitement de la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persister l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Optionnel : Ajouter un message flash pour informer l'utilisateur
            $this->addFlash('success', 'Inscription réussie !');

            // Rediriger ou retourner une réponse
           // return $this->redirectToRoute('app_home'); // Redirection vers la page d'accueil, à adapter selon votre besoin
        }

        // Rendre la vue avec le formulaire
        return $this->render('register/index.html.twig', [
            'registerForm' => $form->createView(),
        ]);
    }
}
