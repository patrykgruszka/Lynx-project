<?php

namespace Lynx\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LynxStatusBundle:Default:index.html.twig');
    }
}
