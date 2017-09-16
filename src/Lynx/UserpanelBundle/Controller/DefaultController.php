<?php

namespace Lynx\UserpanelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/saveData")
     */
    public function saveDataAction(Request $request)
    {
		$data = $request->request->all();
		$em = $this->getDoctrine()->getEntityManager();
		$user = $this->getDoctrine()->getRepository("AppUserBundle:User")->find($this->getUser()->getId());
		$user = new User();
		$user->setName($data["name"]);
		$user->setLastname($data["lastname"]);
		$em->persist($user);
		$em->flush();
		return new JsonResponse(array("status"=>"success"));
    }
	
	/**
     * @Route("/coworkerList")
     */
	public function coworkerListAction()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$rsm = new ResultSetMapping();
		
		$query = $em->createNativeQuery('
				SELECT lu.name as name, lu.lastname as lastname, lu.username as username, lu.email as email, 1 as accepted FROM lynx_user as lu WHERE user_id != ?
				UNION
				SELECT null as name, null as lastname, null as username, li.email as email, 0 as accepted FROM lynx_invite as li'
		, $rsm);
		
		$query->setParameter(1, $this->getUser()->getId());

		$list = $query->getArrayResult();
		
		return new JsonResponse($list);
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
