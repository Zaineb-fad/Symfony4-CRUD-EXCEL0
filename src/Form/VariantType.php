<?php

namespace App\Form;

use App\Entity\Variant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'product',
                'class' => 'form-control'
            )))
            ->add('price',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'product',
                'class' => 'form-control'
            )))
            ->add('oldPrice',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'product',
                'class' => 'form-control'
            )))
            ->add('product',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'product',
                'class' => 'form-control'
            )))
            ->add('sort',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'sort',
                'class' => 'form-control'
            )))
            ->add('cartLines',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'cartLines',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variant::class,
        ]);
    }
}
