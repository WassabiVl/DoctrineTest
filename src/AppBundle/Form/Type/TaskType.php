<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 23/10/2017
 * Time: 09:38
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Task;
use AppBundle\Form\CategoriesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Allowing the user to dynamically add new tags means that you'll need to use some JavaScript.
        // let the user add as many tag forms as they need directly in the browser.
        $builder
            ->add('TaskID', HiddenType::class)
            ->add('TaskDescription', TextareaType::class)
            ->add('category', CategoriesType::class)
            ->add('submit', SubmitType::class)
            ->add('reset', ResetType::class)
            ->add('tags', CollectionType::class, array(
            'entry_type' => TagType::class,
            'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'attr' => array(
                    'class' => 'my-selector',
                ),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class,
        ));
    }
    public function getBlockPrefix()
    {
        return 'TaskType';
    }

}