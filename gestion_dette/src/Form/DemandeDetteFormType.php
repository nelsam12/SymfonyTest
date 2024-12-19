<?php

namespace App\Form;

use App\Entity\DemandeDette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeDetteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createAt', null, [
                'widget' => 'single_text',
            ])
            ->add('montant')
            ->add('montantVerse')
            ->add('updateAt', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeDette::class,
        ]);
    }
}
