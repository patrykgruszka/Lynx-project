<?php

namespace Lynx\SprintBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lynx\SprintBundle\Entity\Sprint;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxSprintBundle:Default:index.html.twig');
    }
    
        /**
     * @Route("/getList")
     */
    public function getList(){
      $em = $this->getDoctrine()->getManager();
      $sprintRepository = $em->getRepository('LynxSprintBundle:Sprint');
      $sprints = $sprintRepository->findAll();

      $serializer = $this->get('jms_serializer');
      $response = $serializer->serialize($sprints,'json');

      return new Response($response);
    }
    
   /**
   * @Route("/save")
   */
  public function saveAction(Request $request)
  {
    $data = json_decode($request->getContent());
    
    $project = $em->getRepository('LynxProjectBundle:Project')->findOneByName($data->project);

    $sprint = new Sprint();
    $sprint->setName($data->name);
    $sprint->setDescription($data->description);
    $sprint->setProject($project);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($sprint);
    $entityManager->flush();

    return new Response();
  }
}
