<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('firstName')
            ->add('lastName')
            ->add('skills', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Creativity' => 'Creativity',
                    'Teamwork' => 'Teamwork',
                    'Curiosity' => 'Curiosity',
                ]
            ])
            ->add('agency')
            ->add('bio')
            ->add('photo')
            ->add('points')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
