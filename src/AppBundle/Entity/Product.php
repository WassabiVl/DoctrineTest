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
    Protected  $productId;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->productId = $id;
    }
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}