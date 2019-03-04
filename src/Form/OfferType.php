<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Alternance' => 'Alternance',
                    'Stage' => 'Stage',
                ),))
            ->add('begin', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('jobDomain')
            ->add('job')
            ->add('salary')
            ->add('tutor')
            ->add('drivingLicence')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
