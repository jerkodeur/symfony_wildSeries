<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('summary', TextareaType::class)
            ->add('poster', UrlType::class, [
                'required' => false
            ])
            ->add(
                'category',
                null,
                [
                    'choice_label' => 'name',
                    'required' => true,
                    'placeholder' => 'choisissez une catégorie'
                ]
            )
            //TODO Declare specific EntityType
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
                'choice_label' => 'name',
                'required' => false,
                'multiple' => true, // Authorize multiple choice
                'expanded' => true, // Transform multiple select to checkboxes
                'by_reference' => false // For manyToMany relation in the inversed side
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
