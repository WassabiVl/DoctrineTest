<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 13/10/2017
 * Time: 13:19
 */

namespace AppBundle\Controller;


use AppBundle\Form\UserProductType;
use AppBundle\Entity\UserProduct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShopCartController extends Controller
{
    /**
     * @Route("/shop", name="shop")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request){
        $product = new UserProduct();
        $form = $this->createForm(UserProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'registration/shop.html.twig',
            array('form' => $form->createView())
        );
    }
}