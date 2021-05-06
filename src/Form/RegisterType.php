<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', Texttype::class, [
                'label' => 'Prénom',
                'constraints' => new Length([
                    'min' =>2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])
            ->add('lastname', Texttype::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' =>2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('email', Texttype::class, [
                'label' => 'Email',
                'constraints' => new Length([
                    'min' =>2,
                    'max' => 60
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre adresse email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' =>'Le mot de passe et la confirmation doivent être identique',
                'label' => 'Mot de passe',
                'required' => true,
                'first_options' => [
                     'label' => 'Mot de passe',
                     'attr' => [
                         'placeholder' => 'Merci de saisir votre mot de passe.'
                     ]
                ],
                'second_options' => [
                    'label' => 'Confirmez mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de confirmez votre mot de passe.'
                    ]
               ]
            ])
            // ----> autre methode pour la confirmation de mdp----
            // ->add('password_confirm', PasswordType::class, [
            //     'label' => 'Mot de passe',
            //     'mapped' => false, // ne rentre pas dans la bdd juste le visuel pour le site 
            //     'attr' => [
            //         'placeholder' => 'Confirmez mot de passe'
            //     ]
            // ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
