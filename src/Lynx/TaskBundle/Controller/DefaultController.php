<?php

namespace Lynx\TaskBundle\Controller;

use Lynx\TaskBundle\LynxTaskBundle;
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
   * @param $status
   * @Route ("/getTasks/{status}", defaults={"status" = "todo"})
   * @return Response
   */
    public function getTasks($status) {
      $repository = $this->getDoctrine()
                         ->getRepository('LynxTaskBundle:Task');

      $query = $repository->createQueryBuilder('t')
          ->innerJoin('t.status', 's')
          ->where('s.shortName = :shortName')
          ->setParameter('shortName', $status)
          ->getQuery();

      $tasks = $query->getResult();
      $serializer = $this->get('jms_serializer');
      $response = $serializer->serialize($tasks,'json');
      return new Response($response);
    }


  /**
     * @Route("/getList")
     */
      public function getList(Request $request){
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

    /**
     * @Route("/updateStatus")
     */
      public function updateStatus(Request $request)
      {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $task = $em->getRepository('LynxTaskBundle:Task')->find($data->id);
        if (!$task) {
          throw $this->createNotFoundException(
              'No task found for id '.$data->id
          );
        }

        $status = $em->getRepository('LynxStatusBundle:Status')->findOneByShortName($data->status);
        if (!$task) {
          throw $this->createNotFoundException(
              'No status found for name '.$$data->status
          );
        }
        $task->setStatus($status);
        $em->flush();

        return new Response();
      }

    }
