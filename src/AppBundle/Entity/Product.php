<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 09/10/2017
 * Time: 15:30
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 *
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    Protected  $ProductID;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ProductName;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $ProductPrice;
    /**
     * @ORM\Column(type="text")
     */
    private $ProductDescription;
    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->ProductName;
    }

    /**
     * @param string $ProductName
     */
    public function setProductName($ProductName)
    {
        $this->ProductName = $ProductName;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->ProductPrice;
    }

    /**
     * @param mixed $ProductPrice
     */
    public function setProductPrice($ProductPrice)
    {
        $this->ProductPrice = $ProductPrice;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->ProductDescription;
    }

    /**
     * @param mixed $ProductDescription
     */
    public function setProductDescription($ProductDescription)
    {
        $this->ProductDescription = $ProductDescription;
    }


}