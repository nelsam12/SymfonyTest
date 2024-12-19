<?php

namespace App\Form;

use App\Enums\Role;

use App\Dto\UserSearchDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserSearchDtoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("nom", TextType::class, [
                'required' => false,
            ])
            ->add("telephone", TextType::class, [
                'required' => false,
            ])
            ->add("email", TextType::class, [
                'required' => false,
            ])
            ->add('role', ChoiceType::class, [
                'required' => false,
                'label' => 'Rôle',
                'choices' => array_combine(
                    array_map(fn(Role $role) => $role->name, Role::cases()), // Noms lisibles
                    array_map(fn(Role $role) => $role->value, Role::cases()) // Valeurs à stocker
                ),
                'placeholder' => 'Tout', // Option par défaut
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500',
                ],
            ])
            ->add("status", TextType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSearchDto::class,
        ]);
    }
}
