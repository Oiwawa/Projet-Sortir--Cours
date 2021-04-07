<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,['label'=>'Pseudo: '])
            ->add('firstName',TextType::class,['label'=>'Prénom: '])
            ->add('lastName',TextType::class,['label'=>'Nom: '])
            ->add('phone',TextType::class,['label'=>'Téléphone: '])
            ->add('mail', TextType::class,['label'=>'Email: '])
            ->add('password', RepeatedType::class,
                ['type' => PasswordType::class,
                'first_options' =>['label'=>'Mot de passe: '],
                'second_options' =>['label' =>'Confirmation: '],
                'invalid_message' =>'Les champs de mots de passe doivent correspondre'])
            ->add('campus', EntityType::class,['class'=>Campus::class, 'choice_label'=>'name'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
