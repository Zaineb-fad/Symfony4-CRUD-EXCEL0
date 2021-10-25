<?php

namespace App\Form;

use App\Entity\Reviews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReviewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'Name',
                'class' => 'form-control'
            )))
            ->add('stars',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'stars',
                'class' => 'form-control'
            )))
            ->add('comment',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'comment',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
