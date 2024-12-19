<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Client;
use function PHPUnit\Framework\isEmpty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfonycasts\DynamicForms\DependentField;
use Symfony\Component\Form\FormBuilderInterface;

use Symfonycasts\DynamicForms\DynamicFormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ClientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('surnom', TextType::class, [
                'required' => false,
            ])
            ->add('telephone', TextType::class, [
                'required' => false,
            ])
            ->add('adresse', TextType::class, [
                'required' => false,
            ])
            ->add('addUser', CheckboxType::class, [
                'label' => 'Ajouter un compte',
                'required' => false,
                'mapped' => false,
            ]);

        $builder->addDependent('compte', 'addUser', function (DependentField $field, ?bool $addUser) {
            if (!$addUser) {
                return;
            }

            $field->add(UserType::class, [
                'label' => false,
            ]);

        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
            // APPLICATION CONDITIONNELLE DU GROUPE
            'validation_groups' => function (FormInterface $form) {
                if ($form->has("addUser") && $form->get("addUser")->getData()) {
                    return ['Default', "WITH_COMPTE"];
                }
                return ['Default'];
            }
        ]);
    }
}
