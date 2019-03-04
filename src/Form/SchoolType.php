<?php

namespace App\Form;

use App\Entity\School;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom'))
            ->add('imageFile', FileType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class)
            ->add('phone', TelType::class, array('label' => 'Telephone'))
            ->add('address1', TextType::class, array('label' => 'Adresse 1'))
            ->add('address2', TextType::class, array('label' => 'Adresse 2', 'required'   => false))
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class, array('label' => 'Ville'))
            ->add('country', TextType::class, array('label' => 'Pays'))
            ->add('uai', TextType::class, array('label' => 'N° UAI', 'required'   => false))
            ->add('siret', TextType::class, array('label' => 'N° SIRET', 'required'   => false))
            ->add('description', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => School::class,
        ]);
    }
}
