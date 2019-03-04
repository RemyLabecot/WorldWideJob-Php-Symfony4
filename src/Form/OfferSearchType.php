<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search_offer', SearchType::class, ['label' => 'Rechercher une offre'])
                ->add('search_filter', ChoiceType::class, [
                    'expanded' => false,
                    'multiple' => false,
                    'label' => 'Type de contrat',
                    'choices' => [
                        'Tous types de contrats' => true,
                        'Stage' => 'Stage',
                        'Alternance' => 'Alternance',
                    ],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
