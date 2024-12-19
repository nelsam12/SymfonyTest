<?php

namespace App\Twig\Components;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsLiveComponent]
class UserComponent extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(UserType::class);
    }


    #[LiveAction]
    public function store(EntityManagerInterface $entityManager, UserPasswordHasherInterface $encoder)
    {
        $this->submitForm();
        $user = $this->getForm()->getData();

        $pictureFile = $user->getPicture();
        if ($pictureFile) {
           

            // Générer un nom unique pour l'image
            $fileName = $user->getNom() . '_' . uniqid() . '.' . $pictureFile->guessExtension();

            // Déplacer le fichier vers le répertoire cible
            $pictureFile->move(
                $this->getParameter('images_directory'), // Chemin défini dans les paramètres
                $fileName
            );
            $user->setPicture('uploads/images/' . $fileName);

            // Associer le chemin de l'image à l'utilisateur
            $user->setPicture($fileName);
        }


        if ($user != null) {
            $hashedPassword = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
        }
        $entityManager->persist($user);
        // Executer la requête
        $entityManager->flush(); // commit the changes

        // Redirection vers la liste des users
        return $this->redirectToRoute('user.index');
    }
}
