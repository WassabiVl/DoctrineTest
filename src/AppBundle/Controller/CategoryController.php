<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 16/10/2017
 * Time: 15:02
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\ProductType;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category_registration")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request){
        $product = new Category();
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
     * @Route("/category/{categoryID}", name = "categoryUpdate")
     * @param $ProductID
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($ProductID, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Category::class)->find($ProductID);

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
     * @Route("/categoryDel/{categoryID}", name = "categoryDel")
     * @param $ProductID
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($ProductID, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Category::class)->find($ProductID);

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
        $this->addFlash('success', 'Product Deleted!');
        return $this->redirectToRoute('home');
    }
}