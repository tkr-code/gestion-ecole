<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\Filiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiliereOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'attr' =>
                [
                    'placeholder' => 'Code Filiere',
                    'class' => 'text-uppercase'
                ]
            ])
            ->add('designation', TextType::class, [
                'attr' =>
                [
                    'placeholder' => 'Designation',
                    'class' => 'text-capitalize'
                ]
            ])
            ->add('departement', EntityType::class, [
                "class" => Departement::class,
                "placeholder" => "Choisir le departement",
                "choice_label" => "designation",

            ])
            ->add(
                'Options',
                ChoiceType::class,
                [
                    'choices' => [
                        'oui' => 'oui',
                        'non' => 'non'
                    ],
                    
                    'mapped' => false,
                    'expanded'=>true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
