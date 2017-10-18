<?php
/**
 * Created by PhpStorm.
 * UserOld: al-atrash
 * Date: 11/10/2017
 * Time: 09:00
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_product")
 */
class UserProduct
{
    /**
     * @param mixed $Amount
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $UserProductID;
    /**
     * @ORM\ManyToOne(targetEntity="UserOld")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(type="integer")
     */
    public $UserID;
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(type="integer")
     */
    public $ProductID;
    /**
     * @ORM\Column(type="datetime")
     */
    public $PurchaseDate;
    /**
     * @ORM\Column(type="integer")
     */
    public $Amount;


    public function __construct()
    {
        $this->UserID = new ArrayCollection();
        $this->ProductID = new ArrayCollection();
        //to set the date to now
        $this->PurchaseDate = new \DateTime();
    }

    /**
     * @return ArrayCollection
     */
    public function getUserID()
    {
        return $this->UserID;
    }

    /**
     * @param mixed $UserID
     */
    public function setUserID($UserID)
    {
        $this->UserID = $UserID;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->ProductID;
    }

    /**
     * @param mixed $ProductID
     */
    public function setProductID($ProductID)
    {
        $this->ProductID = $ProductID;
    }

    /**
     * @return mixed
     */
    public function getPurchaseDate()
    {
        return $this->PurchaseDate;
    }

    /**
     * @param mixed $PurchaseDate
     */
    public function setPurchaseDate($PurchaseDate)
    {
        $this->PurchaseDate = $PurchaseDate;
    }

    /**
     * @return mixed
     */
    public function getUserProductID()
    {
        return $this->UserProductID;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->Amount;
    }
}