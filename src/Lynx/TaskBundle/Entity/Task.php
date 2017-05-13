<?php
namespace Lynx\TaskBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */


class Task {
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
     * @ORM\ManyToOne(targetEntity="Lynx\SprintBundle\Entity\Sprint", inversedBy="tasks")
     * @ORM\JoinColumn(name="sprint_id", referencedColumnName="id")
     */
    private $sprint;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lynx\PriorityBundle\Entity\Priority")
     * @ORM\JoinColumn(name="priority_id", referencedColumnName="id")
     */
    private $priority;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lynx\StatusBundle\Entity\Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;
    
    
    
    public function __construct() {
        
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

    public function getSprint() {
        return $this->sprint;
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

    public function setSprint($sprint) {
        $this->sprint = $sprint;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function setStatus($status) {
        $this->status = $status;
    }



    
}
