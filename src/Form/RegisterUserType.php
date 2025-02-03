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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;




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
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 30,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre mot de passe ne peut pas dépasser {{ limit }} caractères.',
                    ])
                    ]
            ])
            ->add('firstname', TextType::class, [
                'label' => "votre Prénom",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre prénom ne peut pas dépasser {{ limit }} caractères.',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "votre Nom",
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'Votre Nom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre Nom ne peut pas dépasser {{ limit }} caractères.',
                    ])
                    ],
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ],
                
            ])
            ->add('submit', SubmitType::class)
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'constraints' => [
                new UniqueEntity([
                    'fields' => 'email',
                    'message' => 'Cette adresse email est déjà utilisée.',
                ]),
            ],
        ]);
    }
}
