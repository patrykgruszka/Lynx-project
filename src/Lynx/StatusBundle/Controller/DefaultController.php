<?php

namespace Lynx\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxStatusBundle:Default:index.html.twig');
    }
}
