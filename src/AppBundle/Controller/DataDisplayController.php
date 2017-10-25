<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 11/10/2017
 * Time: 13:11
 *  https://symfony.com/doc/master/components/cache.html
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Categories;
use AppBundle\Entity\Product;
use AppBundle\Entity\UserProduct;
use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DataDisplayController
 * @package AppBundle\Controller
 */
class DataDisplayController extends Controller
{

    /**
     * @return Response
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="home")
     */
    public function showAction()
    {


        $cache = new FilesystemCache();
        if (!$cache->has('stats.products')or !$cache->has('stats.userProduct') or !$cache->has('stats.Categories') or !$cache->has('stats.Task')) {
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
            $cache->set('stats.products', $product);

            $userProduct = $this->getDoctrine()
                ->getRepository(UserProduct::class)
                ->findAll();
            $cache->set('stats.userProduct', $userProduct);

            $Categories = $this->getDoctrine()
                ->getRepository(Categories::class)
                ->findAll();
            $cache->set('stats.Categories', $Categories);

            $Task = $this->getDoctrine()
                ->getRepository(Task::class)
                ->findAll();
            $cache->set('stats.Categories', $Task);
        }

        else{
            $product = $cache->get('stats.products');
            $userProduct = $cache->get('stats.userProduct');
            $Categories = $cache->get('stats.Categories');
            $Task = $cache->get('stats.Task');
        }

        if (!$product and !$Categories) {
            throw $this->createNotFoundException(
                'No product found for id ');}

        $cache->clear();

        // ... do something, like pass the $product object into a template
        return $this->render('default/index1.html.twig', array('Products' => $product, 'userProduct' => $userProduct, 'Categories' => $Categories, 'Tasks' => $Task));

    }


}