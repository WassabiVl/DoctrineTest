<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 23/10/2017
 * Time: 09:33
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $taskID;

    /**
     * @ORM\Column(type="string")
     */
    protected $TaskDescription;

    /**
     * @ORM\Column(type="string")
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     * @JoinTable(name="Tag")
     * @Assert\Type(type="Tag")
     * @Assert\Valid()
     */
    protected $tags;

    /**
     * The Valid Constraint has been added to the property category. This cascades the validation to the
     * corresponding entity. If you omit this constraint the child entity would not be validated.
     *
     * @ORM\Column(type="string")
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Categories", cascade={"persist"})
     * @Assert\Type(type="AppBundle\Entity\Categories")
     * @Assert\Valid()
     */
    protected $category;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTaskID()
    {
        return $this->taskID;
    }

    /**
     * @param mixed $taskID
     */
    public function setTaskID($taskID)
    {
        $this->taskID = $taskID;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(Categories $category = null)
    {
        $this->category = $category;
    }

    public function getTaskDescription()
    {
        return $this->TaskDescription;
    }

    public function setTaskDescription($description)
    {
        $this->TaskDescription = $description;
    }

    public function getTags()
    {
        return $this->tags;
    }
    public function __toString()
    {
        return $this->getTaskDescription();
    }

    //To make handling these new tags easier, add an "adder" and a "remover" method for the tags in the Task class:
    //look up jquery bitch, what a pain
    public function addTag(Tag $tag)
    {
        $tag->addTask($this);
        $this->tags->add($tag);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

}