<?php

namespace Lynx\TaskBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lynx\TaskBundle\Entity\Task;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxTaskBundle:Default:index.html.twig');
    }

    /**
     * @Route("/getList")
     */
      public function getList(){
        $em = $this->getDoctrine()->getManager();
        $taskRepository = $em->getRepository('LynxTaskBundle:Task');
        $tasks = $taskRepository->findAll();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($tasks,'json');

        return new Response($response);
      }


      /**
       * @Route("/save")
       */
      public function saveAction(Request $request)
      {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('LynxProjectBundle:Project')->findOneByName($data->project);
        $priority = $em->getRepository('LynxPriorityBundle:Priority')->findOneByName($data->priority);
        $status = $em->getRepository('LynxStatusBundle:Status')->findOneByName($data->status);

        $task = new Task();
        $task->setName($data->name);
        $task->setDescription($data->description);
        $task->setProject($project);
        $task->setPriority($priority);
        $task->setStatus($status);
        if (isset($data->sprint)){
            $sprint = $em->getRepository('LynxSprintBundle:Sprint')->findOneByName($data->sprint);
            $task->setSprint($sprint);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new Response();
      }

    
    
    
    }
