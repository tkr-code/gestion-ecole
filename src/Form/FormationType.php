<?php

namespace App\Form;

use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'designation',
                TextType::class,
                [
                    'attr' =>
                    [
                        'placeholder' => 'Designation',
                        'class'=>'text-capitalize'
                    ]
                ]

            )
            ->add(
                'cout',
                NumberType::class,
                [
                    'attr' =>
                    [
                        'placeholder' => 'Cout de la formation'
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
