<?php
/**
 * Created by IntelliJ IDEA.
 * UserOld: Wassabi.vl
 * Date: 10/15/2017
 * Time: 3:18 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recipient', 'FOS\UserBundle\Form\Type\UsernameFormType');

    }
}