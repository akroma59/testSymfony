<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [

                'label' => "Titre du livre",
                'required' => true,
                'attr' => [
                    'placeholder' => "Titre",
                    'class' => "form-control",
                ],

                'label_attr' => [
                    'class' => "col-4"
                ],
                'help_attr' => [
                    'class' => "text-muted"
                ]
                
            ])

            ->add('description', TextareaType::class, [
                'label' => "Description du livre",
                'required' => true,
                'attr' => [
                    'placeholder' => "Saisir la description",
                    'class' => "form-control",
                ],

                'label_attr' => [
                    'class' => "col-4"
                ],
                'help_attr' => [
                    'class' => "text-muted"
                ]
                
            ])
            ->add('price', NumberType::class, [
                'label' => "Prix du livre",
                'required' => true,
                'attr' => [
                    'placeholder' => "Saisir le prix",
                    'class' => "form-control",
                ],

                'label_attr' => [
                    'class' => "col-4"
                ],
                'help_attr' => [
                    'class' => "text-muted"
                ]
            ])
            // ->add('cover')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
