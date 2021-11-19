<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\ResponsableDepartement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableDepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'date_entre_fonction',
                DateType::class,
                [
                    'widget' => 'single_text'
                ]
            )
            ->add(
                'date_sortie_fonction',
                DateType::class,
                ['widget' => 'single_text',
                'required'=>false]
            )
            ->add(
                'departement',
                EntityType::class,
                [
                    'class' => Departement::class,
                    'choice_label' => 'designation',
                    'placeholder' => 'choisir le departement à diriger'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResponsableDepartement::class,
        ]);
    }
}
