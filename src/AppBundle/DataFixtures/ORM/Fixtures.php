<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 13/10/2017
 * Time: 10:49
 *
 * to run, if the first time disable UP
 * php bin/console doctrine:fixtures:load --append
 * https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use AppBundle\Entity\UserOld;
use AppBundle\Entity\UserProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        $time= new \DateTime("now");
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setProductName('product '.$i);
            $product->setProductPrice(mt_rand(10, 100));
            $product->setProductDescription('description '.$i);
            $users = new UserOld();
            $users->setUserName('name'.$i);
            $users->setUserEmail('user'.$i.'@user.com');
            $users->setUserPassword(mt_rand(10, 100));
            $UP = new UserProduct();
            $UP->setAmount(mt_rand(10, 100));
            $UP->setUserID(mt_rand(1, 10));
            $UP->setProductID(mt_rand(1, 10));
            $UP->setPurchaseDate($time);
            $manager->persist($product);
            $manager->persist($users);
            $manager->persist($UP);
        }

        $manager->flush();
    }
}