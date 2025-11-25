<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
