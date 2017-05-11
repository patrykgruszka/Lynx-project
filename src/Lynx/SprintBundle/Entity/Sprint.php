<?php

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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="sprints")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="sprint")
     */
    private $tasks;
    
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
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


}
