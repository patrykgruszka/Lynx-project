<?php

namespace Lynx\PriorityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LynxPriorityBundle:Default:index.html.twig');
    }
}
