<?php
namespace Lynx\SprintBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="lynx_sprint")
 */



class Sprint {
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lynx\ProjectBundle\Entity\Project", inversedBy="sprints")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="Lynx\TaskBundle\Entity\Task", mappedBy="sprint")
     */
    private $tasks;
    
    public function __construct()
    {
    }
    
    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getId() {
        return $this->id;
    }

    public function getProject() {
        return $this->project;
    }

    public function getTasks() {
        return $this->tasks;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProject($project) {
        $this->project = $project;
    }

    public function setTasks($tasks) {
        $this->tasks = $tasks;
    }



    /**
     * Add task
     *
     * @param \Lynx\TaskBundle\Entity\Task $task
     *
     * @return Sprint
     */
    public function addTask(\Lynx\TaskBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \Lynx\TaskBundle\Entity\Task $task
     */
    public function removeTask(\Lynx\TaskBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }
}
