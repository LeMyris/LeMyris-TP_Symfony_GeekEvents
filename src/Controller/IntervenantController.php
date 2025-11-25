<?php

namespace App\Controller;

use App\Entity\Intervenant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IntervenantController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    #[Route('/intervenant', name: 'app_intervenant')]
    public function index(): Response
    {
        return $this->render('intervenant/index.html.twig', [
            'controller_name' => 'IntervenantController',
        ]);
    }

    #[Route("/intervenant/create", name: 'app_intervenant_create')]
    public function create(Request $request): Response
    {
        $intervenant = new Intervenant();
        $formBuilder = $this->createFormBuilder($intervenant);

        $formBuilder->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('submit', SubmitType::class);

        $formulaire = $formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()) {
            $intervenant = $formulaire->getData();

            $this->entityManager->persist($intervenant);
            $this->entityManager->flush();
        }

        return $this->render('intervenant/create.html.twig', [
            'form' => $formulaire,
        ]);
    }
}
