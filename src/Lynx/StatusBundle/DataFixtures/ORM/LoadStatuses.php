<?php

namespace Lynx\StatusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lynx\StatusBundle\Entity;

class LoadStatuses implements FixtureInterface, ContainerAwareInterface {

  private $container;

  public function setContainer( ContainerInterface $container = null ) {
    $this->container = $container;
  }

  public function load( ObjectManager $manager ) {
    $priorities = [
        [
            "name"        => "To do",
            "description" => ""
        ],
        [
            "name"        => "In progress",
            "description" => ""
        ],
        [
            "name"        => "Done",
            "description" => ""
        ]
    ];

    foreach ($priorities as $priority) {
      $entity = new Entity\Status();
      $entity->setName($priority["name"]);
      $entity->setDescription($priority["description"]);
      $manager->persist( $entity );
    }

    $manager->flush();
  }

}
