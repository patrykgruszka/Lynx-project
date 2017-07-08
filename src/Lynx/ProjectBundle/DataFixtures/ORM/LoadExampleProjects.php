<?php

namespace Lynx\ProjectBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lynx\ProjectBundle\Entity;

class LoadExampleProjects implements FixtureInterface, ContainerAwareInterface {

  private $container;

  public function setContainer( ContainerInterface $container = null ) {
    $this->container = $container;
  }

  public function load( ObjectManager $manager ) {
    $projects = [
        [
            "name"        => "Example project",
            "description" => "Pellentesque et purus sed lectus maximus porta vel quis velit. Donec purus leo, egestas ut dictum eu, lacinia at velit."
        ]
    ];

    foreach ( $projects as $project ) {
      $entity = new Entity\Project();
      $entity->setName( $project["name"] );
      $entity->setDescription( $project["description"] );
      $manager->persist( $entity );
    }

    $manager->flush();
  }

}
