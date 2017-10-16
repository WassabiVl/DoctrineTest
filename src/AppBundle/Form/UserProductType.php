<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Product;

class UserProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $product = new Product();
        $product = $product->getProductName();
        $builder
            ->add('UserProductID', HiddenType::class)
            ->add('UserID', TextType::class)
//            ->add('ProductID', ChoiceType::class, array(
//                'entry_options'  => array(
//                'choices' =>
//                    $product
//                ,
//                'choice_label' => function($Product, $key, $index) {
//                    /** @var Product $Product */
//                    return strtoupper($Product->getProductName());
//                },)))
            ->add('ProductID', TextType::class)
            ->add('PurchaseDate',DateTimeType::class)
            ->add('Amount', TextType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserProduct'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_userproduct';
    }


}