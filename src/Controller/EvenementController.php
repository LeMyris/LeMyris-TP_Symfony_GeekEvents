<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Evenement;
use App\Entity\Intervenant;
use App\Entity\Organisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvenementController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {

    }
    #[Route('/evenement', name: 'app_evenement')]
    public function index(): Response
    {
        return $this->render('evenement/manage.html.twig', [
            'evenements' => $this->entityManager->getRepository(Evenement::class)->findAll()
        ]);
    }

    #[Route("/evenement/create", name: 'app_evenement_create')]
    public function create(Request $request): Response
    {
        $evenement= new Evenement();
        $formBuilder=$this->createFormBuilder( $evenement);

        $formBuilder->add('nom', TextType::class)
            ->add('Date', TextType::class)
            ->add('lieu', TextType::class)
            ->add('description', TextType::class, ["required" => false])
            ->add('nombrebParticipant', IntegerType::class)
            ->add('activite', EntityType::class, ["class" => Activite::class])
            ->add('Intervenant', EntityType::class, ["class" => Intervenant::class, "multiple" => true,"expanded" => true,])
            ->add('Organisateur', EntityType::class, ["class" => Organisateur::class])
            ->add('submit', SubmitType::class);

        $formulaire=$formBuilder->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted()){
            $evenement=$formulaire->getData();

            $this->entityManager->persist($evenement);
            $this->entityManager->flush();
        }

        return $this->render('evenement/create.html.twig', [
            'form' =>   $formulaire,
            'produits' => []
        ]);
    }
}
