<?php
/**
 * Created by PhpStorm.
 * User: remy
 * Date: 29/11/18
 * Time: 16:54
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EarlyBirdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email')
        ->add(
            'role',
            HiddenType::class,
            [
                'mapped' => false,
            ]
        )
        ->add(
            'password',
            HiddenType::class,
            [
                'required' => false,
                'empty_data' => 'testtest1',
            ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
