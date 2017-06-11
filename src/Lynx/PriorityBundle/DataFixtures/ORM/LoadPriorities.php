<?php

//src/Example/UserBundle/DataFixtures/ORM/LoadUsers.php

namespace Lynx\PriorityBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lynx\PriorityBundle\Entity;

class LoadPriorities implements FixtureInterface, ContainerAwareInterface {

  private $container;

  public function setContainer( ContainerInterface $container = null ) {
    $this->container = $container;
  }

  public function load( ObjectManager $manager ) {
    $priorities = [
        [
            "name"        => "Minior",
            "description" => ""
        ],
        [
            "name"        => "Major",
            "description" => ""
        ],
        [
            "name"        => "Critical",
            "description" => ""
        ]
    ];

    foreach ($priorities as $priority) {
      $entity = new Entity\Priority();
      $entity->setName($priority["name"]);
      $entity->setDescription($priority["description"]);
      $manager->persist( $entity );
    }

    $manager->flush();
  }

}
