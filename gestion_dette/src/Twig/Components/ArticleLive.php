<?php

namespace App\Twig\Components;

use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsLiveComponent]
class ArticleLive extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ArticleFormType::class);
    }

    #[LiveAction]
    public function store(EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder)
    {
        $this->submitForm();
        $article = $this->getForm()->getData();
       
        $entityManager->persist($article);
        // Executer la requête
        $entityManager->flush(); // commit the changes

        return $this->redirectToRoute('article.index');
    }
}
