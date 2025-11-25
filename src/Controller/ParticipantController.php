<?php

namespace App\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ParticipantController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }
    #[Route('/participant', name: 'app_participant')]
    public function index(): Response
    {
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }

    #[Route("/participant/create", name: 'app_participant_create')]
    public function create(Request $request): Response
    {
        $participant = new Participant();
        $formBuilder = $this->createFormBuilder($participant);

        $formBuilder->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('submit', SubmitType::class);

        $formulaire = $formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()) {
            $participant = $formulaire->getData();

            $this->entityManager->persist($participant);
            $this->entityManager->flush();
        }

        return $this->render('participant/create.html.twig', [
            'form' => $formulaire,
        ]);
    }
}
