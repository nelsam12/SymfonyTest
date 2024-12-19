<?php

namespace App\Controller;

use App\core\PaginationModel;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/clients', name: 'client.index')]
    public function index(Request $request, ClientRepository $clientRepository): Response
    {
        $currentPage = $request->query->getInt('page', 1);
        $pageSize = 2; // Items per page

        $queryBuilder = $clientRepository->createQueryBuilder('e');

        $pagination = PaginationModel::paginate($queryBuilder, $pageSize, $currentPage);
        return $this->render('client/liste.html.twig', [
            'clients' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'client.index',
        ]);
    }
    #[IsGranted('ROLE_ADMIN', message: "Seul l'administrateur peut ajouter un utilisateur")]
    #[Route('/clients/store', name: 'client.store', methods: ['GET'])]
    public function store(): Response
    {
        return $this->render('client/form.html.twig', []);
    }
}
