<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Filiere;
use App\Entity\Salle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('designation')
            ->add('filiere',EntityType::class,[
                'class'=>Filiere::class,
                'choice_label'=>function($filiere){
                    return $filiere->getCode().' - '.$filiere->getDesignation();
                }
            ])
            ->add('salles',EntityType::class,[
                'class'=>Salle::class,
                'choice_label'=>function($salle){
                    return $salle->getNumero().' '.$salle->getNom();
                },
                'multiple'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
