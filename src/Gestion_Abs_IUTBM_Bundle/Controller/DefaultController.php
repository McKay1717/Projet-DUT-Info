<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {
	/**
	 * @Route("/accueil", name="accueil")
	 */
	public function indexAction(){
		return $this->render('Gestion_Abs_IUTBM_Bundle:Default:login.html.twig');
	}
}
