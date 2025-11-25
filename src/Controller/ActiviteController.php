<?php

namespace App\Controller;

use App\Entity\Activite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActiviteController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    #[Route('/activite', name: 'app_activite')]
    public function index(): Response
    {
        return $this->render('activite/index.html.twig', [
            'controller_name' => 'ActiviteController',
        ]);
    }

    #[Route("/activite/create", name: 'app_activite_create')]
    public function create(Request $request): Response
    {
        $activite= new Activite();
        $formBuilder=$this->createFormBuilder( $activite);

        $formBuilder->add('nom', TextType::class)
            ->add('submit', SubmitType::class);

        $formulaire=$formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()){
            $activite=$formulaire->getData();

            $this->entityManager->persist($activite);
            $this->entityManager->flush();
        }

        return $this->render('activite/create.html.twig', [
            'form' =>   $formulaire,
        ]);
    }
}
