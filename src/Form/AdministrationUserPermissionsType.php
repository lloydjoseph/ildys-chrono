<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministrationUserPermissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iIdUser', HiddenType::class, [
                'required' => false
            ])
            ->add('bAjoutCourrier', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter un courrier',
                'required' => false
            ])
            ->add('bModifCourrier', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier un courrier',
                'required' => false
            ])
            ->add('bSupprCourrier', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer un courrier',
                'required' => false
            ])
            ->add('bAjoutNoteInfo', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter une note d\'information',
                'required' => false
            ])
            ->add('bModifNoteInfo', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier une note d\'information',
                'required' => false
            ])
            ->add('bSupprNoteInfo', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer une note d\'information',
                'required' => false
            ])
            ->add('bAjoutNoteServ', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter une note de service',
                'required' => false
            ])
            ->add('bModifNoteServ', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier une note de service',
                'required' => false
            ])
            ->add('bSupprNoteServ', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer une note de service',
                'required' => false
            ])
            ->add('Sauvegarder', SubmitType::class, [
                'attr' => ['class' => 'btn-blue mt-2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
}