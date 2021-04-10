<?php

namespace App\Form;

use App\Entity\Season;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', null, [
                'label' => 'Numéro de saison'
            ])
            ->add('year', null, [
                'label' => 'Année de sortie'
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control']
            ])
            ->add('program', null, ['choice_label' => 'title']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
