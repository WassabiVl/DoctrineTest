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
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $CategoryID;
    /**
     * @ORM\Column(type="string")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product")
     */
    private $CategoryName;


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
        $this->CategoryName = new ArrayCollection();
    }


}