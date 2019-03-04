<?php

namespace App\Form;

use App\Entity\Experience;
use App\Entity\Skill;
use App\Entity\Student;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, array(
                'choices'  => array(
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                    'Mlle' => 'Mlle',
                ),))
            ->add('firstname')
            ->add('lastname')
            ->add('birthdate', BirthdayType::class, array(
                'format' => 'dd-MM-yyyy',))
            ->add('ine')
            ->add('phone', TelType::class)
            ->add('address1')
            ->add('address2')
            ->add('zipcode')
            ->add('city')
            ->add('country')
            ->add('imageFile', FileType::class, [
                'required' => false,
                ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'multiple' => true,
                'attr' => ['class' => 'formSkill'],
                'by_reference' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
