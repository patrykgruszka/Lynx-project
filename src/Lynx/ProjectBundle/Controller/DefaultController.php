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
     * @Route("/get")
     */
    public function getAction(){
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('LynxProjectBundle:Project');
        $projects = $projectRepository->findAll();
        $input = "";
        foreach ($projects as $project) {
            $input = $input.$project->getName()."\r\n";
        }
        return $this->render('default/demo/demo.html.twig', [
        'input' => $input,
        ]
        );
    }
    
    /**
     * Creates a new Post entity.
     *
     * @Route("/new", name="admin_post_new")
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function newAction(Request $request)
    {
        $user = new User();
        //$post->setAuthor($this->getUser());
        $user->setName($request->request->get('name'));
        $user->setLastname($request->request->get('lastname'));
        $user->setType($request->request->get('type'));
        // See http://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
        /*/*$form = $this->createForm(PostType::class, $post)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);
*/
        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
 //       if ($form->isSubmitted() && $form->isValid()) {
 //           $post->setSlug($this->get('slugger')->slugify($post->getTitle()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See http://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'post.created_successfully');
            return $this->redirectToRoute('users');
//            return new Response('Created user '.$user->getName());
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
    
    return json_encode($data);
  }
    
    
}
