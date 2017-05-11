<?php

namespace Lynx\SprintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LynxSprintBundle:Default:index.html.twig');
    }
}
