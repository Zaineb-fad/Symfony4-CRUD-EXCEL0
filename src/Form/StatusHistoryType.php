<?php

namespace App\Form;

use App\Entity\StatusHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StatusHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('status',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'status',
                'class' => 'form-control'
            )))

            ->add('statusDate')
            ->add('statusOrder',TextType::class,array(
            'required' => true,
            'attr' => array(
              'placeholder' => 'statusOrder',
                'class' => 'form-control'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StatusHistory::class,
        ]);
    }
}
