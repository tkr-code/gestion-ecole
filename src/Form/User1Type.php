<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personne',PersonneType::class,[
                'label'=>false
                ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>'Email',
                ]
            ])            
            ->add('etat',ChoiceType::class,[
                'choices'=>$this->etats()
            ])
            ->add('isVerified')
        ;
    }

    public function etats(){
        return [
            'Activer'=>'Activer',
            'Désactiver'=>'Désactiver',
        ];
    }
    public function roles(){
        return [
            'Administrateur'=>'ROLE_ADMIN',
            'Professseur'=>'ROLE_PROFESSEUR',
            'Responsable'=>'ROLE_RESPONSABLE',
            'Etudiant'=>'ROLE_ETUDIANT',
            'Tuteur'=>'ROLE_TUTEUR'
        ];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
             'translation_domain'=>'forms',

        ]);
    }
}