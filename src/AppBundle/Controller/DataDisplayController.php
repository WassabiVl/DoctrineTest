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
     * @Route("/", name="home")
     */
    public function showAction()
    {
        $cachedCategories = $this->get('cache.app')
            ->getItem('product');
        if (!$cachedCategories->isHit()) { //if not found
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
            $cachedCategories->set($product);
            $this->get('cache.app')->save($cachedCategories);
        } else {
            $product = $cachedCategories->get();
        }
        $cache = new FilesystemCache();
        if (!$cache->has('stats.users')) {
            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll()
            ;
            $cache->set('stats.users', $users);
        }else {
            $users = $cache->get('stats.users');
        }
//        $users = $this->getDoctrine()
//            ->getRepository(User::class)
//            ->findAll();

        if (!$product or !$users) {
            throw $this->createNotFoundException(
                'No product found for id '
            );
        }

        // ... do something, like pass the $product object into a template
        return $this->render('default/index1.html.twig', array('Products' => $product, 'Users' => $users));
    }


}