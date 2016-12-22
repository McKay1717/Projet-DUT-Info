<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Gestion_Abs_IUTBM_Bundle\Entity\Abscence;
use Gestion_Abs_IUTBM_Bundle\Form\AbscenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Abscence controller.
 *
 * @Route("abscence")
 */
class AbscenceController extends Controller {


    /**
     * Lists and manage absencesof studants
     *
     * @param Request $request
     *
     * @Route("/", name="absences")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function absencesAction(Request $request) {

        $absences = new Abscence();
        $form = $this->createForm(AbscenceType::class, $absences);

        $em = $this->getDoctrine()->getManager();
        $user = $request->getSession()->get('user');
        $absences = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->findBy(array('user' => $user));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            if ($form->isValid()) {
                echo $data->get('debutAbs');
                echo $data->get('finAbs');
                echo $data->get('fichJustificatif');
            } else {
                return $this->render('Gestion_Abs_IUTBM_Bundle:Default:index.html.twig', array(
                    'form' => $form->createView(),
                    'absences' => $absences,
                    'user' => $user,
                    'erreur' => true
                ));
            }
        }

        return $this->render('Gestion_Abs_IUTBM_Bundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'absences' => $absences,
            'user' => $user
        ));
    }


}
