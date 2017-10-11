<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 11/10/2017
 * Time: 13:11
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DataDisplayController
 * @package AppBundle\Controller
 */
class DataDisplayController extends Controller
{

    /**
     * @return Response
     * @Route("/")
     */
    public function showAction()
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        if (!$users) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }
        // ... do something, like pass the $product object into a template
        return $this->render('default/index1.html.twig', array('Products' => $product, 'Users' => $users));
    }


}