<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 11/10/2017
 * Time: 13:11
 *  https://symfony.com/doc/master/components/cache.html
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\UserOld;
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
        $product=array();
        $users=array();
        $cache = new FilesystemCache();
        if (!$cache->has('stats.products') or !$cache->has('stats.users')) {
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
            $users = $this->getDoctrine()
                ->getRepository(UserOld::class)
                ->findAll();
            $cache->set('stats.products', $product);
            $cache->set('stats.users', $users);}
        else{
            $users = $cache->get('stats.users');
            $product = $cache->get('stats.products');
        }

        if (!$product and !$users) {
            throw $this->createNotFoundException(
                'No product found for id ');}

        $cache->clear();

        // ... do something, like pass the $product object into a template
        return $this->render('default/index1.html.twig', array('Products' => $product, 'Users' => $users));

    }


}