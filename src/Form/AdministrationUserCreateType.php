<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministrationUserCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vPrenomUser', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('vNomUser', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('vIdentifiant', TextType::class, [
                'attr' => [
                    'class' => 'inp-text w-100 mb-1'
                ]
            ])
            ->add('bAdmin', CheckboxType::class, [
                'attr' => [
                    'class' => 'mb-2'
                ],
                'required' => false
            ])
            ->add('bActif', HiddenType::class)
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
            'data_class' => Utilisateur::class,
        ]);
    }
}
