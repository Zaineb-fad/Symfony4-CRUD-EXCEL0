<?php

namespace App\Form;

use App\Entity\Transportation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TransportationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'color',
                'class' => 'form-control'
            )))
            ->add('licencePlate',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'licencePlate',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transportation::class,
        ]);
    }
}
