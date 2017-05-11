<?php

namespace SprintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SprintBundle:Default:index.html.twig');
    }
}
