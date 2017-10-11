<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 11/10/2017
 * Time: 09:00
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_product")
 */
class UserProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $UserProductID;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="UserID")
     * @ORM\JoinColumn(name="UserID", referencedColumnName="UserID")
     * @ORM\Column(type="integer")
     */
    public $UserID;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumn(name="ProductID", referencedColumnName="ProductID")
     * @ORM\Column(type="integer")
     */
    public $ProductID;
    /**
     * @ORM\Column(type="datetime")
     */
    public $PurchaseDate;
}