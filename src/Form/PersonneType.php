<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Nom',
                    'class'=>'text-capitalize'
                ]
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=>'Prénom',
                    'class'=>'text-capitalize'
                ]
            ])
            ->add('profession',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Profession',
                    'class'=>'text-capitalize'
                ]
            ])
             ->add('avatar',FileType::class,[
                'label'=>'avatar ( jpg or png )  ',
                'multiple'=>false,
                'mapped'=>false,
                'required'=>false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image document',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
