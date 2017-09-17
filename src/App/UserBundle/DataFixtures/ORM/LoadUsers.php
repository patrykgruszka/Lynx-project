<?php

namespace App\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\UserBundle\Entity\User;

class LoadUsers implements FixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $user = new User();
        $password = 'testPass';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setUsername('admin');
        $user->setName('Admin');
        $user->setLastname('Admin');
        $user->setPassword($encoded);
        $user->setEmail('admin@example.com');
		$user->setRoles(array('ROLE_PROJECT_MASTER'));
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();
    }

}
