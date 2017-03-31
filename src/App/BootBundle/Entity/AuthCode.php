<?php

namespace App\BootBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use Doctrine\ORM\Mapping as ORM;

/**
 * AuthCode
 *
 * @ORM\Table(name="lynx_oauth_code")
 * @ORM\Entity(repositoryClass="App\BootBundle\Repository\AuthCodeRepository")
 */
class AuthCode extends BaseAuthCode
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
    * @ORM\ManyToOne(targetEntity="Client")
    * @ORM\JoinColumn(nullable=false)
    */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\User")
     */
    protected $user;
}

