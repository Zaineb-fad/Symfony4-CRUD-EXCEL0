<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'slug',
                'class' => 'form-control'
            )))

            ->add('description',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'descrition',
                'class' => 'form-control'
            )))
            ->add('price',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'descrition',
                'class' => 'form-control'
            )))
            ->add('oldPrice',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'descrition',
                'class' => 'form-control'
            )))
            ->add('category',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'category',
                'class' => 'form-control'
            )))
            ->add('images',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'images',
                'class' => 'form-control'
            )))

            ->add('createAt')
            ->add('variants',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'variants',
                'class' => 'form-control'
            )))

            ->add('subCategory',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'Name',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
