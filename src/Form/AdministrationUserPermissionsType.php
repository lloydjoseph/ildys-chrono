<?php

namespace App\Form;

use App\Entity\Permission;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministrationUserPermissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courrierAdd', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter un courrier',
                'required' => false
            ])
            ->add('courrierDel', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer un courrier',
                'required' => false
            ])
            ->add('courrierMod', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier un courrier',
                'required' => false
            ])
            ->add('informationAdd', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter un courrier',
                'required' => false
            ])
            ->add('informationDel', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer un courrier',
                'required' => false
            ])
            ->add('informationMod', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier un courrier',
                'required' => false
            ])
            ->add('serviceAdd', CheckboxType::class, [
                'label' => 'L\'utilisateur peut ajouter un courrier',
                'required' => false
            ])
            ->add('serviceDel', CheckboxType::class, [
                'label' => 'L\'utilisateur peut supprimer un courrier',
                'required' => false
            ])
            ->add('serviceMod', CheckboxType::class, [
                'label' => 'L\'utilisateur peut modifier un courrier',
                'required' => false
            ])
            ->add('Sauvegarder', SubmitType::class, [
                'attr' => ['class' => 'btn-blue mt-2'],
            ])
        ;

        $builder
            ->get('courrierAdd')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('courrierDel')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('courrierMod')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('informationAdd')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('informationDel')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('informationMod')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('serviceAdd')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('serviceDel')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));

        $builder
            ->get('serviceMod')
            ->addModelTransformer(new CallbackTransformer(function ($activeAsString) { return (bool)(int)$activeAsString;}, function ($activeAsBoolean) { return (string)(int)$activeAsBoolean; }));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
}

function a() {

}