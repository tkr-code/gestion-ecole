<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\CoefficientMatiere;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoefficientMatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valeur',NumberType::class)
            ->add('class',EntityType::class,[
                'class'=>Classe::class,
                'choice_label'=>'designation'
            ])
            ->add('matiere',EntityType::class,[
                'class'=>Matiere::class,
                'choice_label'=>'designation'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CoefficientMatiere::class,
        ]);
    }
}
