<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 18/10/2017
 * Time: 10:13
 */

namespace AppBundle\DataFixtures\ORM;


class FixtureData
{
    private $categories = array(
        1=>"Computer",
        2=>"Hardware",
        3=>"Accessories",
        4=>"Random",
        5=>"Devices",
        6=>"Others"
    );
    private $products = array(
        1=> "Mouse",2=>"Screen",3=> "Keyboard",4=> "CPU",5=> "printer",6=> "Board", 7=> "Camera"
    );
    private $names = array(
        1=> "Suchanek", 2=>"Fabian",3=>"Kasneci", 4=> "Gjergji", 5=>"Hoffart",6=> "Johannes",
        7=>"Lewis-Kelham",8=> "Edwin",
        9=>"Kuzey",10=> "Erdal",
        11=>"Biega", 12=>"Joanna",13=> "Asia",
        14=>"Mahdisoltani",15=> "Farzaneh",
        16=>"Weikum",17=> "Gerhard",
        18=>"Rebele", 0=>"Thomas"
    );

    /**
     * @return array
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function __toString()
    {
        return $this->getNames();
    }
}