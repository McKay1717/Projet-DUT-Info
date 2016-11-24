<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Gestion_Abs_IUTBM_Bundle\Entity\Abscence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Abscence controller.
 *
 * @Route("abscence")
 */
class AbscenceController extends Controller
{
    /**
     * Lists all abscence entities.
     *
     * @Route("/", name="abscence_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abscences = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->findAll();

        return $this->render('abscence/index.html.twig', array(
            'abscences' => $abscences,
        ));
    }

    /**
     * Creates a new abscence entity.
     *
     * @Route("/new", name="abscence_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $abscence = new Abscence();
        $form = $this->createForm('Gestion_Abs_IUTBM_Bundle\Form\AbscenceType', $abscence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($abscence);
            $em->flush($abscence);

            return $this->redirectToRoute('abscence_show', array('id' => $abscence->getId()));
        }

        return $this->render('abscence/new.html.twig', array(
            'abscence' => $abscence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a abscence entity.
     *
     * @Route("/{id}", name="abscence_show")
     * @Method("GET")
     */
    public function showAction(Abscence $abscence)
    {
        $deleteForm = $this->createDeleteForm($abscence);

        return $this->render('abscence/show.html.twig', array(
            'abscence' => $abscence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing abscence entity.
     *
     * @Route("/{id}/edit", name="abscence_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Abscence $abscence)
    {
        $deleteForm = $this->createDeleteForm($abscence);
        $editForm = $this->createForm('Gestion_Abs_IUTBM_Bundle\Form\AbscenceType', $abscence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abscence_edit', array('id' => $abscence->getId()));
        }

        return $this->render('abscence/edit.html.twig', array(
            'abscence' => $abscence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a abscence entity.
     *
     * @Route("/{id}", name="abscence_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Abscence $abscence)
    {
        $form = $this->createDeleteForm($abscence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abscence);
            $em->flush($abscence);
        }

        return $this->redirectToRoute('abscence_index');
    }

    /**
     * Creates a form to delete a abscence entity.
     *
     * @param Abscence $abscence The abscence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Abscence $abscence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abscence_delete', array('id' => $abscence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
