<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('trackNumber',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'fullName',
                'class' => 'form-control'
            )))
            ->add('fullName',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'fullName',
                'class' => 'form-control'
            )))
            ->add('phone',TelType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'number',
                'class' => 'form-control'
            )))
            ->add('orderDate')
            ->add('status',IntegerType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'fullName',
                'class' => 'form-control'
            )))
            ->add('orderBookDate')
            ->add('bookTalbe',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'booktable',
                'class' => 'form-control'
            )))
            ->add('adress',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'adress',
                'class' => 'form-control'
            )))
            ->add('deliveryOption',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'deliveryOption',
                'class' => 'form-control'
            )))
            ->add('city',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'city',
                'class' => 'form-control'
            )))
            ->add('note',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'Note',
                'class' => 'form-control'
            )))
            ->add('carts',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'carts',
                'class' => 'form-control'
            )))
            ->add('statusHistory',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'statusHistory',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
