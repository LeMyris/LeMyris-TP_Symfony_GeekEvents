<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Evenement;
use App\Entity\Intervenant;
use App\Entity\Organisateur;
use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('Date')
            ->add('lieu')
            ->add('nombreParticipant')
            ->add('activite', EntityType::class, [
                'class' => Activite::class,
                'choice_label' => 'id',
            ])
            ->add('Intervenant', EntityType::class, [
                'class' => Intervenant::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Organisateur', EntityType::class, [
                'class' => Organisateur::class,
                'choice_label' => 'id',
            ])
            ->add('Participant', EntityType::class, [
                'class' => Participant::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
