<?php

namespace App\BootBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;

/**
 * RefreshToken
 *
 * @ORM\Table(name="lynx_oauth_refresh_token")
 * @ORM\Entity(repositoryClass="App\BootBundle\Repository\RefreshTokenRepository")
 */
class RefreshToken extends BaseRefreshToken
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

