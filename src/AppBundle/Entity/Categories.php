<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 16/10/2017
 * Time: 14:02
 *
 * to handle relationships between tables
 * https://knpuniversity.com/screencast/symfony-forms/data-class-type-guessing#play
 *
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Category
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="CategoryRepository")
 * @ORM\Table(name="category")
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $CategoryID;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $CategoryName;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="ProductID")
     *  @ORM\JoinColumn(name="ProductID", referencedColumnName="id")
     */
    private $Product;
    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->CategoryID;
    }

    /**
     * @param mixed $CategoryID
     */
    public function setCategoryID($CategoryID)
    {
        $this->CategoryID = $CategoryID;
    }

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

    public function __toString()
    {
        return $this->getCategoryName();
    }

    public function __construct()
    {
        $this->Product = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->Product;
    }

    /**
     * @param mixed $Product
     */
    public function setProduct($Product)
    {
        $this->Product = $Product;
    }


}