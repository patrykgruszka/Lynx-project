<?php

namespace Lynx\ProjectBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lynx\ProjectBundle\Entity\Project;

class DefaultController extends Controller
{


    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LynxProjectBundle:Default:index.html.twig');
    }

    /**
     * @param $id
     * @Route ("/getProject/{id}")
     * @return Response
     */
    public function getProject($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('LynxProjectBundle:Project');
        $task = $repository->find($id);

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($task, 'json');
        return new Response($response);
    }

    /**
     * @Route("/getList")
     */
    public function getList()
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('LynxProjectBundle:Project');
        $projects = $projectRepository->findAll();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize($projects, 'json');

        return new Response($response);
    }


    /**
     * @Route("/save")
     */
    public function saveAction(Request $request)
    {
        $data = json_decode($request->getContent());
        $project = new Project();
        $project->setName($data->name);
        $project->setDescription($data->description);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($project);
        $entityManager->flush();

        return new Response();
    }

}
