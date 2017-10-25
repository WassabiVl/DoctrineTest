<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 16/10/2017
 * Time: 15:02
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CategoriesType;
use AppBundle\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category)
            ->add('submit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'Category Created!');
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'registration/Category.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/category/{categoryID}", name = "category_update")
     * @param $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Categories $category, Request $request)
    {
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$category
            );
        }
        $form = $this
            ->createForm(CategoriesType::class, $category)
            ->add('submit', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'category Updated!');
            return $this->redirectToRoute('home');

        }
        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user
        return $this->render(
            'registration/Category.html.twig',
            array('form' => $form->createView())
        );

    }
    /**
     * @Route("/categoryDel/{categoryID}", name = "categoryDel")
     * @param $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Categories $category, Request $request)
    {
        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$category
            );
        }
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'category Deleted!');
        return $this->redirectToRoute('home');
    }
}