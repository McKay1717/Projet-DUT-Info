<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Gestion_Abs_IUTBM_Bundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller {
	/**
	 * Lists all user entities.
	 *
	 * @Route("/", name="user_index")
	 * 
	 * @method ("GET")
	 */
	public function indexAction() {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException ();
		}
		$em = $this->getDoctrine ()->getManager ();
		
		$users = $em->getRepository ( 'Gestion_Abs_IUTBM_Bundle:User' )->findAll ();
		
		return $this->render ( 'user/abscences.html.twig', array (
				'users' => $users 
		) );
	}
	
	/**
	 * Creates a new user entity.
	 *
	 * @Route("/new", name="user_new")
	 * 
	 * @method ({"GET", "POST"})
	 */
	public function newAction(Request $request) {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException ();
		}
		$user = new User ();
		$form = $this->createForm ( 'Gestion_Abs_IUTBM_Bundle\Form\UserType', $user );
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $user );
			$em->flush ( $user );
			
			return $this->redirectToRoute ( 'user_show', array (
					'id' => $user->getId () 
			) );
		}
		
		return $this->render ( 'user/new.html.twig', array (
				'user' => $user,
				'form' => $form->createView () 
		) );
	}
	
	/**
	 * Finds and displays a user entity.
	 *
	 * @Route("/{id}", name="user_show")
	 * 
	 * @method ("GET")
	 */
	public function showAction(User $user) {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException ();
		}
		$deleteForm = $this->createDeleteForm ( $user );
		
		return $this->render ( 'user/show.html.twig', array (
				'user' => $user,
				'delete_form' => $deleteForm->createView () 
		) );
	}
	
	/**
	 * Displays a form to edit an existing user entity.
	 *
	 * @Route("/{id}/edit", name="user_edit")
	 * 
	 * @method ({"GET", "POST"})
	 */
	public function editAction(Request $request, User $user) {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException ();
		}
		$deleteForm = $this->createDeleteForm ( $user );
		$editForm = $this->createForm ( 'Gestion_Abs_IUTBM_Bundle\Form\UserType', $user );
		$editForm->handleRequest ( $request );
		
		if ($editForm->isSubmitted () && $editForm->isValid ()) {
			$this->getDoctrine ()->getManager ()->flush ();
			
			return $this->redirectToRoute ( 'user_edit', array (
					'id' => $user->getId () 
			) );
		}
		
		return $this->render ( 'user/edit.html.twig', array (
				'user' => $user,
				'edit_form' => $editForm->createView (),
				'delete_form' => $deleteForm->createView () 
		) );
	}
	
	/**
	 * Deletes a user entity.
	 *
	 * @Route("/{id}", name="user_delete")
	 * 
	 * @method ("DELETE")
	 */
	public function deleteAction(Request $request, User $user) {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException ();
		}
		$form = $this->createDeleteForm ( $user );
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			$em = $this->getDoctrine ()->getManager ();
			$em->remove ( $user );
			$em->flush ( $user );
		}
		
		return $this->redirectToRoute ( 'user_index' );
	}
	
	/**
	 * Creates a form to delete a user entity.
	 *
	 * @param User $user
	 *        	The user entity
	 *        	
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(User $user) {
		if (! $this->get ( 'security.authorization_checker' )->isGranted ( 'ROLE_ADMIN' )) {
			throw $this->createAccessDeniedException();
    	}
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
