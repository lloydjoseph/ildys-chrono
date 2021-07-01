<?php

namespace App\Form;

use App\Entity\Courrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourrierCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iNumero', HiddenType::class)
            ->add('vLibelle', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1',
                    'placeholder' => 'Limite de 210 caractères',
                    'maxlength' => 210,
                    'onkeyup' => 'checkErrorInput(this, 210)'
                ]
            ])
            ->add('vDestinataire', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1',
                    'placeholder' => 'Limite de 110 caractères',
                    'maxlength' => 110,
                    'onkeyup' => 'checkErrorInput(this, 110)'
                ]
            ])
            ->add('dDateCreation', DateTimeType::class, [
                'attr' => [
                    'hidden' => true
                ],
                'label' => false
            ])
            ->add('iIdUser', HiddenType::class)
            ->add('Creer', SubmitType::class, [
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
