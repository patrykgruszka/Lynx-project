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
     * @param $id
     * @Route ("/getTask/{id}")
     * @return Response
     */
    public function getTask($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('LynxTaskBundle:Task');
        $task = $repository->find($id);

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($task, 'json');
        return new Response($response);
    }


    /**
     * @Route ("/getTasks/{status}/{projectId}/{sprintId}")
     * @param $status
     * @param bool $projectId
     * @param bool $sprintId
     * @return Response
     */
    public function getTasks($status, $projectId = false, $sprintId = false)
    {
        $repository = $this->getDoctrine()
            ->getRepository('LynxTaskBundle:Task');

        $queryBuilder = $repository->createQueryBuilder('t')
            ->innerJoin('t.status', 's')
            ->innerJoin('t.project', 'p')
            ->innerJoin('t.sprint', 'sp')
            ->where('s.shortName = :shortName')
            ->andWhere('p.id = :projectId')
            ->andWhere('sp.id = :sprintId')
            ->setParameters([
                'shortName' => $status,
                'projectId' => $projectId,
                'sprintId' => $sprintId
            ]);

        $query = $queryBuilder->getQuery();
        $tasks = $query->getResult();
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($tasks, 'json');
        return new Response($response);
    }


    /**
     * @Route("/getList")
     */
    public function getList(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $taskRepository = $em->getRepository('LynxTaskBundle:Task');
        $tasks = $taskRepository->findAll();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($tasks, 'json');

        return new Response($response);
    }


    /**
     * @Route("/save")
     */
    public function saveAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('LynxProjectBundle:Project')->find($data->project);
        $priority = $em->getRepository('LynxPriorityBundle:Priority')->find($data->priority);
        $status = $em->getRepository('LynxStatusBundle:Status')->find($data->status);
        $reporter = $em->getRepository('AppUserBundle:User')->find($data->reporter);

        $task = new Task();
        $task->setName($data->name);
        $task->setDescription($data->description);
        $task->setProject($project);
        $task->setPriority($priority);
        $task->setStatus($status);
        $task->setReporter($reporter);

        if (!empty($data->assignee)) {
            $assignee = $em->getRepository('AppUserBundle:User')->find($data->assignee);
            $task->setAssignee($assignee);
        } else {
            $task->setAssignee(null);
        }

        if (isset($data->sprint)) {
            $sprint = $em->getRepository('LynxSprintBundle:Sprint')->find($data->sprint);
            $task->setSprint($sprint);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();


        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "Task was successfully created"
        ), 'json');
        return new Response($response);
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
                'No task found for id ' . $data->id
            );
        }

        $status = $em->getRepository('LynxStatusBundle:Status')->findOneByShortName($data->status);
        if (!$task) {
            throw $this->createNotFoundException(
                'No status found for name ' . $$data->status
            );
        }
        $task->setStatus($status);
        $em->flush();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "Task status successfully updated"
        ), 'json');
        return new Response($response);
    }

    /**
     * @Route("/update")
     */
    public function update(Request $request)
    {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $task = $em->getRepository('LynxTaskBundle:Task')->find($data->id);
        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id ' . $data->id
            );
        }

        $project = $em->getRepository('LynxProjectBundle:Project')->find($data->project);
        $priority = $em->getRepository('LynxPriorityBundle:Priority')->find($data->priority);
        $status = $em->getRepository('LynxStatusBundle:Status')->find($data->status);
        $reporter = $em->getRepository('AppUserBundle:User')->find($data->reporter);

        $task->setName($data->name);
        $task->setDescription($data->description);
        $task->setProject($project);
        $task->setPriority($priority);
        $task->setStatus($status);
        $task->setReporter($reporter);

        if (!empty($data->assignee)) {
            $assignee = $em->getRepository('AppUserBundle:User')->find($data->assignee);
            $task->setAssignee($assignee);
        } else {
            $task->setAssignee(null);
        }

        if (isset($data->sprint)) {
            $sprint = $em->getRepository('LynxSprintBundle:Sprint')->find($data->sprint);
            $task->setSprint($sprint);
        }

        $em->flush();
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "Task was successfully updated"
        ), 'json');
        return new Response($response);
    }

    /**
     * @Route("/remove")
     */
    public function remove(Request $request)
    {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();

        $task = $em->getRepository('LynxTaskBundle:Task')->find($data->id);
        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id ' . $data->id
            );
        }

        $em->remove($task);
        $em->flush();
        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "Task was successfully deleted"
        ), 'json');
        return new Response($response);
    }

}
