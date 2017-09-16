<?php

namespace App\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="lynx_user")
 * @ORM\Entity(repositoryClass="App\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
	protected $name;
	
	/**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, unique=true)
     */
	protected $lastname;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
	
	function getName()
	{
		return $this->name;
	}

	function getLastname()
	{
		return $this->lastname;
	}

	function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}

	function setLastname($lastname)
	{
		$this->lastname = $lastname;
		
		return $this;
	}

}

