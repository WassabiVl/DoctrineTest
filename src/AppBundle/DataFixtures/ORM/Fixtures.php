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
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fixtureData= new FixtureData;
        $categoryData=$fixtureData->getCategories();
        $productsData=$fixtureData->getProducts();
        $nameData =$fixtureData->getNames();
        // create 20 products! Bam!
        $time= new \DateTime("now");
        for ($i = 0; $i < 20; $i++) {
            $Name1 = array_rand(array_flip($nameData), 2);
            $nameDate= $Name1[0]. ' '. $Name1[1];
            $nameEmail = $Name1[0]. '.'. $Name1[1];
            $product = new Product();
            $product->setProductName(array_rand(array_flip($productsData)));
            $product->setProductPrice(mt_rand(10, 100));
            $product->setProductDescription('description '.$i);
            $product->setCategoryID(array_rand($categoryData));
            $users = new UserOld();
            $users->setUserName($nameDate);
            $users->setUserEmail($nameEmail.'@user.com');
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