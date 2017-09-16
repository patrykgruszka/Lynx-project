<?php

namespace Lynx\UserpanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\ORM\Query\ResultSetMapping;
use Lynx\UserpanelBundle\Entity\Invite;
use App\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
		$user = $this->getDoctrine()->getRepository("AppUserBundle:User")->find($this->getUser()->getId());
        return $this->render('LynxUserpanelBundle:Default:index.html.twig', array("user"=>$user));
    }


	/**
     * @Route("/updateProfile")
     */
    public function updateProfile(Request $request)
    {
        $data = json_decode($request->getContent());
		$em = $this->getDoctrine()->getEntityManager();
		$user = $this->getDoctrine()->getRepository("AppUserBundle:User")->find($this->getUser()->getId());

		$user->setName($data->name);
		$user->setLastname($data->lastname);
		$user->setEmail($data->email);
		$user->setUsername($data->username);
		$em->persist($user);
		$em->flush();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "User data was successfully updated"
        ), 'json');

        return new Response($response);
    }

    /**
     * @Route("/getProfile")
     */
    public function getProfile() {
        $user = $this->getDoctrine()->getRepository("AppUserBundle:User")->find($this->getUser()->getId());

        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['salt', 'password', 'plainPassword', 'timezone', 'emailCanonical', 'confirmationToken']);
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $response = $serializer->serialize($user, 'json');
        return new Response($response);
    }

    /**
     * @Route("/getUsers")
     */
    public function getUsers() {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes(['salt', 'password', 'plainPassword', 'timezone', 'emailCanonical', 'confirmationToken']);
        $encoder = new JsonEncoder();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $response = $serializer->serialize($users, 'json');

        return new Response($response);
    }

    /**
     * @Route("/addUser")
     */
    public function addUser(Request $request)
    {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getEntityManager();

        $user = new User();
        $password = $data->password;
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setUsername($data->username);
        $user->setName($data->name);
        $user->setLastname($data->lastname);
        $user->setPassword($encoded);
        $user->setEmail($data->email);
        if ($data->role == 'ROLE_PROJECT_MASTER') {
            $user->setRoles(['ROLE_PROJECT_MASTER', 'ROLE_USER']);
        } else {
            $user->setRoles(['ROLE_USER']);
        }
        $user->setEnabled($data->enabled);

        $em->persist($user);
        $em->flush();

        $serializer = $this->get('jms_serializer');
        $response = $serializer->serialize(array(
            "status" => "success",
            "msg" => "User was successfully created"
        ), 'json');

        return new Response($response);
    }

	/**
     * @Route("/sendInvitation")
     */
	public function sendInvitationAction($email, $reinv, \Swift_Mailer $mailer){
		$em = $this->getDoctrine()->getEntityManager();
		$invite = $this->getDoctrine()->getRepository("LynxUserpanelBundle:Invite")->findBy(array('email'=>$email));
		if(!$reinv && $invite){
			return new JsonResponse(array("status" => 'failed'));
		}elseif($invite){
			$em->remove($invite);
		}
		
		$invite = new Invite();
		$invite->setEmail($email)
				->setCreateDate(new \DateTime());
		$em->persist($invite);
		$em->flush();
		$hash = md5(uniqid($email, true));
		$message = (new \Swift_Message('Zostałeś zaproszony do współpracy w Lynx'))
		->setFrom($this->getParameter('mailer_user')."@".$this->getParameter('mailer_host'))
		->setTo($email)
		->setBody(
			$this->renderView(
				'Emails/invitation.html.twig',
				array('hash' => $hash)
			),
			'text/html'
		);

		$mailer->send($message);
		return new JsonResponse(array("status" => 'sended'));
	}
}
