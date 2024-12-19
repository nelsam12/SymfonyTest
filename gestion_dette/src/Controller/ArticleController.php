<?php

namespace App\Controller;

use App\core\PaginationModel;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'article.index')]
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $currentPage = $request->query->getInt('page', 1);
        $pageSize = 2; // Items per page

        $queryBuilder = $articleRepository->createQueryBuilder('e');

        $pagination = PaginationModel::paginate($queryBuilder, $pageSize, $currentPage);
        return $this->render('article/index.html.twig', [
            'articles' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'article.index',
        ]);
    }

    #[Route('/articles/store', name: 'article.store')]
    public function store(): Response
    {
        return $this->render('article/form.html.twig', []);
    }
}
