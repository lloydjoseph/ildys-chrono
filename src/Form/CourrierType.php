<?php

namespace App\Form;

use App\Entity\Courrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', NumberType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('subject', TextareaType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1 resize-vertical',
                    'rows' => '1'
                ]
            ])
            ->add('recipient', TextareaType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1 resize-vertical',
                    'rows' => '1'
                ]
            ])
//            ->add('service', TextType::class, [
//                'attr' => ['class' => 'inp-text w-100 mb-1']
//            ])
            ->add('creationDate', DateTimeType::class)
            ->add('Ajouter', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-blue'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Courrier::class,
        ]);
    }
}