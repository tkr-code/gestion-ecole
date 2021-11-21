<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Formation;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('matricule',TextType::class,[
            //     'attr'=>[
            //         'placehoder'=>'Matricule'
            //     ]
            // ])
            ->add('personne',PersonneType::class,[
                'label'=>false,
                'mapped'=>false
            ])
            ->add('occupation')
            ->add('formation',EntityType::class,[
                'class'=>Formation::class,
                'choice_label'=>'designation',
                'placeholder'=>'Choisir la formation'
            ])
            ->add('filiere',EntityType::class,[
                'class'=>Filiere::class,
                'choice_label'=>'designation',
            ])
            // ->add('Provenance',TextType::class,[
            //     'attr'=>[
            //         'placeholder'=>'Ecole de prévenace'
            //     ]
            // ])
            // ->add('parent_etudiant')
            // ->add('dossier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
