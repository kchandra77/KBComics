<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Classe\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ->add('string', TextType::class, [
        //     'label' => false,
        //     'required' => false,
        //     'attr' => [
        //         'placeholder' => 'Votre recherche ...',
        //         'class' =>'form-control-sm'
        //     ]
        // ])
        ->add('categories', EntityType::class, [ //lie une entity de recherche ici category 
            'label' => false,
            'required' => false,
            'class' => Genre::class,
            'multiple' => true,
            'expanded' => true
        ])
        // ->add('author', EntityType::class, [ //lie une entity de recherche ici category 
        //     'label' => false,
        //     'required' => false,
        //     'class' => Author::class,
        //     'multiple' => true,
        //     'expanded' => true
        // ])
        // ->add('editor', EntityType::class, [ //lie une entity de recherche ici category 
        //     'label' => false,
        //     'required' => false,
        //     'class' => Editor::class,
        //     'multiple' => true,
        //     'expanded' => true
        // ])
        ->add('submit', SubmitType::class, [
            'label' => 'Filtrer',
            'attr' => [
                'class' =>'btn-block btn-info'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return ''; 
    }

}