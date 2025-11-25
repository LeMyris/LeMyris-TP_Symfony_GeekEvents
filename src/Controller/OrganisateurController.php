<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
