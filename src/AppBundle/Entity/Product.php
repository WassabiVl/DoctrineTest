<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 09/10/2017
 * Time: 15:30
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Category;


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
     *  @Assert\NotBlank()
     */
    private $ProductName;

    /**
     * @ORM\Column(type="decimal", scale=2)
     *
     */
    private $ProductPrice;

    /**
     * @ORM\Column(type="text")
     */
    private $ProductDescription;



    /**
     * @ORM\Column(type="string")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false )
     */
    private $CategoryName;

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->CategoryName;
    }

    /**
     * @param mixed $CategoryName
     */
    public function setCategoryName($CategoryName)
    {
        $this->CategoryName = $CategoryName;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->ProductID;
    }
    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->ProductName;
    }

    /**
     * @param mixed $ProductID
     */
    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
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