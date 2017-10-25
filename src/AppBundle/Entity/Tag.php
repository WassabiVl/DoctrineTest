<?php
/**
 * Created by PhpStorm.
 * User: al-atrash
 * Date: 23/10/2017
 * Time: 09:35
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Task;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    Protected $TagID;
    /**
     * @ORM\Column(type="string")
     */
    private $TagName;

    /**
     * @ORM\Column(type="string")
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Task", cascade={"persist"},mappedBy="Task")
     */
    protected $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getName()
    {
        return $this->TagName;
    }

    /**
     * @return mixed
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param mixed $tasks
     */
    public function setTasks($tasks)
    {
        $this->tasks = $tasks;
    }

    public function setName($name)
    {
        $this->TagName = $name;
    }
    //multiform shit to do here
    public function addTask(Task $task)
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
        }
    }
    public function __toString()
    {
        return $this->getName();
    }
}