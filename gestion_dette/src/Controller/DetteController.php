<?php

namespace App\Controller;

use App\core\PaginationModel;
use App\Repository\ArticleRepository;
use App\Repository\ClientRepository;
use App\Repository\DetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetteController extends AbstractController
{
    #[Route('/dettes', name: 'dette.index')]
    public function index(DetteRepository $detteRepository, Request $request): Response
    {
        $currentPage = $request->query->getInt('page', 1);
        $pageSize = 2; // Items per page

        $queryBuilder = $detteRepository->createQueryBuilder('e');

        $pagination = PaginationModel::paginate($queryBuilder, $pageSize, $currentPage);
        return $this->render('dette/index.html.twig', [
            'dettes' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'client.index',
        ]);
    }

    #[IsGranted('ROLE_ADMIN', message: "Seul l'administrateur peut ajouter une dette")]
    #[Route('/dettes/store', name: 'dette.store')]
    public function store(ClientRepository $clientRepository, ArticleRepository $articleRepository): Response
    {
        $clients = $clientRepository->findAll();
        $articles = $articleRepository->findAll();
        return $this->render('dette/form.html.twig', [
            // 'clients' => $clients,
            // 'articles' => $articles,
        ]);
    }
}
