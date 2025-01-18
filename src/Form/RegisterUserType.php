<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;



class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "votre adresse email",
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Votre mot de passe ', 'hash_property_path' => 'password',
                    'attr' => [
                    'placeholder' => 'Votre mot de passe'
                ]
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => [
                    'placeholder' => 'Confirmez votre mot de passe'
                ]
                ],
                'mapped' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => "votre Prénom",
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "votre Nom",
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('submit', SubmitType::class)
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
