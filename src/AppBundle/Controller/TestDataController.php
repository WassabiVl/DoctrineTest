<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 13/10/2017
 * Time: 17:04
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TestDataController extends Controller
{
    /**
     * @Route("/test")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayData(){
            $Product = new Product();
            $form = $this ->createFormBuilder($Product)
                ->add('Products', CollectionType::class, array(
                    'ProductID' => HiddenType::class,
                    'ProductName'=> TextType::class,
                    'ProductPrice'=> MoneyType::class,
                    'ProductDescription' => TextareaType::class,
                    'allow_add'     => true,
                    'allow_delete'  => true,
                    'prototype'     => true,
                    'label'         => false,
                    'by_reference'  => false))
                ->getForm()
            ;

            return $this->render('default/new.html.twig', array(
                'form' => $form->createView(),
            ));
        }
}