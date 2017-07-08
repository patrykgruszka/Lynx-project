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
    $statuses = [
        [
            "name"        => "To do",
            "shortName" => "todo",
            "description" => ""
        ],
        [
            "name"        => "In progress",
            "shortName" => "in-progress",
            "description" => ""
        ],
        [
            "name"        => "Done",
            "shortName" => "done",
            "description" => ""
        ]
    ];

    foreach ($statuses as $status) {
      $entity = new Entity\Status();
      $entity->setName($status["name"]);
      $entity->setShortName($status["shortName"]);
      $entity->setDescription($status["description"]);
      $manager->persist( $entity );
    }

    $manager->flush();
  }

}
