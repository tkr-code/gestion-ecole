<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Personne;
use App\Entity\Departement;
use App\Entity\ResponsableDepartement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ResponsableDepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'personne',
                PersonneType::class,
                ['label' => false]

            )
            
            ->add(
                'email',
                EmailType::class,

            )
            ->add('password',PasswordType::class,[
                'attr'=>[
                    'placeholder'=>'Mot de passe'
                ]
            ])

            ->add(
                'date_entre_fonction',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'mapped'=>false
                ]
            )
            ->add(
                'date_sortie_fonction',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'required' => false,
                    'mapped'=>false
                ]
            )
            ->add(
                'departement',
                EntityType::class,
                [
                    'class' => Departement::class,
                    'choice_label' => 'designation',
                    'placeholder' => 'choisir le departement à diriger',
                    'mapped'=>false
                ]
            )
            ->add('etat',ChoiceType::class,[
                'choices'=>User::etats
            ])
            ->add('isVerified')
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
