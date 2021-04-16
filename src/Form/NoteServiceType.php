<?php

namespace App\Form;

use App\Entity\NoteService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iNumero', NumberType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('vLibelle', TextareaType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1 resize-vertical',
                    'rows' => '1'
                ]
            ])
            ->add('vService', TextType::class, [
                'attr' => ['class' => 'inp-text w-100 mb-1']
            ])
            ->add('dDateCreation', DateTimeType::class)
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
            'data_class' => NoteService::class,
        ]);
    }
}
