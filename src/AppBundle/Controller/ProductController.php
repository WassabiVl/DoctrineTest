<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 11/10/2017
 * Time: 14:53
 */

namespace AppBundle\Controller;


use AppBundle\Form\ProductType;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product_registration")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request){
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'registration/Product.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/Product/{ProductID}", name = "ProductUpdate")
     * @param $ProductID
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($ProductID, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($ProductID);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$product
            );
        }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user
        return $this->render(
            'registration/Product.html.twig',
            array('form' => $form->createView())
        );

    }
    /**
     * @Route("/ProductDel/{ProductID}", name = "ProductDel")
     * @param $ProductID
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($ProductID, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($ProductID);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$product
            );
        }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}