<?php

namespace App\Controller;

use App\Enums\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Dto\UserSearchDto;
use App\core\PaginationModel;
use App\Form\UserSearchDtoType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/users', name: 'user.index')]
    public function index(Request $request, UserRepository $userRepository): Response
    {

        $userSearchDto = new UserSearchDto();
        $formSearch = $this->createForm(UserSearchDtoType::class, $userSearchDto);
        $formSearch->handleRequest($request);

        $currentPage = $request->query->getInt('page', 1);
        $pageSize = 2; // Items per page

        $queryBuilder = $userRepository->createQueryBuilder('e');

        $pagination = PaginationModel::paginate($queryBuilder, $pageSize, $currentPage);
        return $this->render('user/index.html.twig', [
            'users' => $pagination->getItems(),
            'pagination' => $pagination,
            'route' => 'user.index',
        ]);
    }

    // Seul l'administrateur peut faire ça

    #[IsGranted('ROLE_ADMIN', message: "Seul l'administrateur peut ajouter un utilisateur")]
    #[Route('/users/add', name: 'user.add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'csrf_protection' => false, // Désactive la protection CSRF
        ]);
        //  Récupération des données du formulaire
        $form->handleRequest($request);
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Hashage du mot de passe
            $password = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            // Persistance du nouvel utilisateur
            $entityManager->persist($user);

            // Exécution de la requête
            $entityManager->flush();

            // Redirection vers la liste des utilisateurs
            return $this->redirectToRoute('user.index');
        }
        // Si le formulaire n'est pas valide ou initial
        return $this->render('user/add.html.twig', [
            'form' => $form->createView(),
        ], new Response('', $form->isSubmitted() ? 422 : 200));
    }


    #[IsGranted('ROLE_ADMIN', message: "Seul l'administrateur peut ajouter un utilisateur")]
    #[Route('/users/stre', name: 'user.store')]
    public function store(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder): Response
    {

        // Si le formulaire n'est pas valide ou initial
        return $this->render('user/add.html.twig', []);
    }
}
