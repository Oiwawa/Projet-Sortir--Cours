<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Event;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=> 'Nom de la sortie: '])
            ->add('limitDate', DateTimeType::class, ['widget' => 'single_text', 'label'=> 'Date limite d\'inscription: '])
            ->add('eventDate', DateTimeType::class, ['widget' => 'single_text', 'label'=> 'Date et heure de la sortie: '])
            ->add('nbrPlace', IntegerType::class, ['label'=> 'Nombre de places: '])
            ->add('duration', TimeType::class, ['widget' => 'single_text', 'label'=> 'Durée: '])
            ->add('description', TextareaType::class, ['label'=> 'Description et infos: '])
            ->add('campus', EntityType::class,['class'=>Campus::class, 'choice_label'=>'name'])
            ->add('city', EntityType::class, ['class'=>Ville::class, 'choice_label'=>'name'])
            ->add('place', PlaceType::class, ['label' => ' '])
            ->add('register', SubmitType::class, ['attr'=>['value'=>1],'label' => 'Enregistrer'])
            ->add('publish', SubmitType::class, ['attr'=>['value'=>2],'label' => 'Publier la sortie'])
            ->add('cancel', ResetType::class, ['label' => 'Annuler'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}