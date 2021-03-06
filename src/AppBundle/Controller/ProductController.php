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
            $this->addFlash('success', 'Product Created!');
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'registration/Product.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/Product/{ProductID}", name = "product_update")
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Product $product, Request $request)
    {
        if (!$product) {
            $this->addFlash('Failure', 'Product not found');
            return $this->redirectToRoute('home');
        }
        $product->setCategoryName($product);
        $form = $this
            ->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash('success', 'Product Updated!');
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
     * @Route("/ProductDel/{ProductID}", name = "product_del")
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Product $product, Request $request)
    {

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$product
            );
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        $this->addFlash('Success', 'Product Deleted!');
        return $this->redirectToRoute('home');
    }
}