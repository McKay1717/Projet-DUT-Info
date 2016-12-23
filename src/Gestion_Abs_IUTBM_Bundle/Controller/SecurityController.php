<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityController extends Controller {
	/**
	 * @Route("/login", name="login")
	 */
	public function loginAction(Request $request)
	{
		$user = $this->getUser();

		if ($user instanceof UserInterface) {
			return $this->redirectToRoute('/');
		}

		/** @var AuthenticationException $exception */
		$exception = $this->get('security.authentication_utils')->getLastAuthenticationError();
	
		return $this->render('Gestion_Abs_IUTBM_Bundle:Default:login.html.twig', [
            'error' => $exception ? $exception->getMessage() : NULL,
		]);

	}

}