<?php

namespace App\Form;

use App\Enums\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfonycasts\DynamicForms\DynamicFormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);
        $builder
            ->add("picture", FileType::class, [
                'label' => 'Image (JPG/PNG/GIF)',
                'required' => false,
            ])
            ->add('nom', TextType::class, [
                'required' => false,
            ])
            ->add('prenom', TextType::class, [
                'required' => false,
            ])
            ->add('login', TextType::class, [
                'required' => false,
            ])
            ->add('password', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'text-white w-full'
                ]
            ])

            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => Role::ADMIN->value,
                    'Boutiquier' => Role::BOUTIQUIER->value,
                ],
                'expanded' => true,  // Checkbox (true) ou select (false)
                'multiple' => true,  // Autorise plusieurs choix
                'label' => 'Roles',
            ])
            // CRSF
            ->add('_token', HiddenType::class, [
                'label' => false,
                'csrf_protection' => false,  // Désactive la protection CSRF (pour les formulaires non sécurisés)"
                "mapped" => false, //

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
