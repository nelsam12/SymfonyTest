<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeDetteController extends AbstractController
{
    #[IsGranted('ROLE_CLIENT', message: "")]
    #[Route('/demandedettes', name: 'demandedette.index')]
    public function index(): Response
    {
        return $this->render('demande_dette/index.html.twig', [
            
        ]);
    }
}
