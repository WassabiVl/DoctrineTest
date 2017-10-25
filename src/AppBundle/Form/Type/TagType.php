<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 23/10/2017
 * Time: 09:37
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// With this, you have enough to render a tag form by itself. But since the end goal is to allow the tags of a
// Task to be modified right inside the task form itself, create a form for the Task class

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TagID', HiddenType::class)
            ->add('TagName')
            ->add('submit', SubmitType::class)
            ->add('reset', ResetType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tag::class,
        ));
    }
}