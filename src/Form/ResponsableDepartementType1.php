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

class ResponsableDepartementType1 extends AbstractType
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
