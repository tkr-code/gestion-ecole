<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero_villa',TextType::class,['attr'=>['placeholder'=>'numero de la villa','class'=>'text-capitalize']])
            ->add(
                'quartier',
                TextType::class,
                ['attr' => ['placeholder' => 'quartier', 'class' => 'text-capitalize']]
            )
            ->add('rue',TextType::class, ['attr' => ['placeholder' => 'rue', 'class' => 'text-capitalize']])
            ->add('pays', TextType::class, ['attr' => ['placeholder' => 'pays', 'class' => 'text-uppercase']])
            ->add('ville', TextType::class, ['attr' => ['placeholder' => 'ville', 'class' => 'text-capitalize']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
