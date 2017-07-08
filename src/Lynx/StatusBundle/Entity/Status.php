<?php
namespace Lynx\StatusBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="status")
 */


class Status {
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $shortName;

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
    
    public function __construct() {
        
    }
    
    public function getName() {
        return $this->name;
    }

    public function getShortName() {
        return $this->shortName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setShortName($shortName) {
        $this->shortName = $shortName;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setId($id) {
        $this->id = $id;
    }

}
