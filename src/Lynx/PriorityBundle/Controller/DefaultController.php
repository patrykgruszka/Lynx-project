<?php

namespace Lynx\PriorityBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lynx\PriorityBundle\Entity\Priority;





class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxPriorityBundle:Default:index.html.twig');
    }
    /**
     * @Route("/getList")
     */
    public function getList(){
      $em = $this->getDoctrine()->getManager();
      $priorityRepository = $em->getRepository('LynxPriorityBundle:Priority');
      $priorities = $priorityRepository->findAll();

      $serializer = $this->get('jms_serializer');
      $response = $serializer->serialize($priorities,'json');

      return new Response($response);
    }
    
   /**
   * @Route("/save")
   */
  public function saveAction(Request $request)
  {
    $data = json_decode($request->getContent());


    $priority = new Priority();
    $priority->setName($data->name);
    $priority->setDescription($data->description);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($priority);
    $entityManager->flush();

    return new Response();
  }
}
