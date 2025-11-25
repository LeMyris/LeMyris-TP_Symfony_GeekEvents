<?php

namespace App\Controller;

use App\Entity\Organisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrganisateurController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }
    #[Route('/organisateur', name: 'app_organisateur')]
    public function index(): Response
    {
        return $this->render('organisateur/index.html.twig', [
            'controller_name' => 'OrganisateurController',
        ]);
    }

    #[Route("/organisateur/create", name: 'app_organisateur_create')]
    public function create(Request $request): Response
    {
        $organisateur = new Organisateur();
        $formBuilder = $this->createFormBuilder($organisateur);

        $formBuilder->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('submit', SubmitType::class);

        $formulaire = $formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()) {
            $organisateur = $formulaire->getData();

            $this->entityManager->persist($organisateur);
            $this->entityManager->flush();
        }

        return $this->render('organisateur/create.html.twig', [
            'form' => $formulaire,
        ]);
    }
}
