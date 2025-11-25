<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UtilisateurController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route("/utilisateur/create", name: 'app_utilisateur_create')]
    public function create(Request $request): Response
    {
        $utilisateur = new Utilisateur();
        $formBuilder = $this->createFormBuilder($utilisateur);

        $formBuilder->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('submit', SubmitType::class);

        $formulaire = $formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()) {
            $activite = $formulaire->getData();

            $this->entityManager->persist($activite);
            $this->entityManager->flush();
        }

        return $this->render('produit/create.html.twig', [
            'form' => $formulaire,
        ]);
    }
}
