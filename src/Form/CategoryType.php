<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class CategoryType extends AbstractType
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

            ->add('brochure',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'brochure',
                'class' => 'form-control'
            )))

            ->add('imageUrl',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'subcategories',
                'class' => 'form-control'
           )))
            ->add('createDate')
            ->add('products',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'products',
                'class' => 'form-control'
            )))

            ->add('subCategories',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'subcategories',
                'class' => 'form-control'
           )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
