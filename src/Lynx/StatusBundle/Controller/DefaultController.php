<?php

namespace Lynx\StatusBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lynx\StatusBundle\Entity\Status;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxStatusBundle:Default:index.html.twig');
    }
        /**
     * @Route("/getList")
     */
    public function getList(){
      $em = $this->getDoctrine()->getManager();
      $statusRepository = $em->getRepository('LynxStatusBundle:Status');
      $statuses = $statusRepository->findAll();

      $serializer = $this->get('jms_serializer');
      $response = $serializer->serialize($statuses,'json');

      return new Response($response);
    }
    
   /**
   * @Route("/save")
   */
  public function saveAction(Request $request)
  {
    $data = json_decode($request->getContent());


    $status = new Status();
    $status->setName($data->name);
    $status->setDescription($data->description);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($status);
    $entityManager->flush();

    return new Response();
  }
}
