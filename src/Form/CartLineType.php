<?php

namespace App\Form;

use App\Entity\CartLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CartLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'variant',
                'class' => 'form-control'
            )))
            ->add('variant',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'variant',
                'class' => 'form-control'
            )))
            ->add('cart',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'cart',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CartLine::class,
        ]);
    }
}
