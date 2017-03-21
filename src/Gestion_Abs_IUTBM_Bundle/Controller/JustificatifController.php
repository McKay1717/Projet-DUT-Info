<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Gestion_Abs_IUTBM_Bundle\Entity\Justificatif;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;


class JustificatifController extends Controller {



	public function getJustificatifsAction(Request $request)
	{
		$SCODOC_IP = "0.0.0.0";
		if($request->getClientIp() != $SCODOC_IP)
		{
			throw $this->createAccessDeniedException ();
		}
		$em = $this->getDoctrine()->getManager();
		$justificatifs = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Justificatif')->findAll();
		

	
		$view = View::create($justificatifs);
		$view->setFormat('json');
		return $view;
	}
	
	public function getJustificatifAction($id,Request $request)
	{
		$SCODOC_IP = "0.0.0.0";
		if($request->getClientIp() != $SCODOC_IP)
		{
			throw $this->createAccessDeniedException ();
		}
		$em = $this->getDoctrine()->getManager();
		$justificatif = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Justificatif')
		->find($id);
		
	
		if (empty($justificatif)) {
			return new JsonResponse(['message' => 'Justificatif not found'], Response::HTTP_NOT_FOUND);
		}
		$helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
	
		$view = View::create($helper->asset($justificatif, 'fichier'));
		$view->setFormat('json');
		return $view;
	}
	

}
