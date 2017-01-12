<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use Gestion_Abs_IUTBM_Bundle\Entity\Abscence;
use Gestion_Abs_IUTBM_Bundle\Form\AbscenceAddType;
use Gestion_Abs_IUTBM_Bundle\Form\AbscenceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
 * Abscence controller.
 *
 * @Route("abscence")
 */
class AbscenceController extends Controller {


    /**
     * Lists absences of studant
     *
     * @param Request $request
     *
     * @Route("/", name="absences")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function absencesAction(Request $request) {

    	if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETU')) {
    		return $this->redirectToRoute('accueil');
    	}

        $security = $this->get('security.token_storage');
        $token = $security->getToken();
        $user = $token->getUser();

        $em = $this->getDoctrine()->getManager();
        $absences = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->findByUser($user);

        if ($request->getMethod() == "POST") {
            $id = $request->get('absence');
            //$absence = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->find($id);
            $session = $request->getSession();
            $session->set('absence', $id);
            return $this->redirectToRoute('justification');
        }

        return $this->render('Gestion_Abs_IUTBM_Bundle:Default:abscences.html.twig', array(
            'absences' => $absences,
        ));

    }

    /**
     * Manage absence of studant
     *
     * @param Request $request
     *
     * @Route("/justification", name="justification")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function justificationAction(Request $request) {

    	if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETU')) {
    		return $this->redirectToRoute('login');
    	}

        $session = $request->getSession();
        $id = $session->get('absence');
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->find($id);
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(AbscenceType::class, $absence);
        $debutAbs = $absence->getDebutAbs();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $security = $this->get('security.token_storage');
                $token = $security->getToken();
                $user = $token->getUser();

                $finAbs = $form->getData()->getFinAbs();
                $fileFichJustificatif = $form->getData()->getFileFichJustificatif();

                if ($debutAbs < $finAbs) {
                    $absence->setFinAbs($finAbs);
                    $absence->setFileFichJustificatif($fileFichJustificatif);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('justifier', 'Votre justification a été pris en compte');
                    return $this->redirectToRoute('absences');
                } else {
                    return $this->render('Gestion_Abs_IUTBM_Bundle:Default:justificatif.html.twig', array(
                        'form' => $form->createView(),
                        'debutAbs' => $debutAbs,
                        'erreurDate' => 'La date de retour est censé être après la date de départ'
                    ));
                }

            }

        }

        return $this->render('Gestion_Abs_IUTBM_Bundle:Default:justificatif.html.twig', array(
            'form' => $form->createView(),
            'debutAbs' => $debutAbs
        ));

    }

    /**
     * Add absence
     *
     * @Route("/addAbsence", name="addAbsence")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addFichAbsenceAction(Request $request) {

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETU')) {
            return $this->redirectToRoute('login');
        }

        $absence = new Abscence();
        $form = $this->createForm(AbscenceAddType::class, $absence);
        $em = $this->getDoctrine()->getManager();
        $security = $this->get('security.token_storage');
        $token = $security->getToken();
        $user = $token->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $debutAbs = $form->getData()->getDebutAbs();
                $finAbs = $form->getData()->getFinAbs();
                $fileFichJustificatif = $form->getData()->getFileFichJustificatif();

                if ($debutAbs < $finAbs) {
                    $absence->setDebutAbs($debutAbs);
                    $absence->setFinAbs($finAbs);
                    $absence->setFileFichJustificatif($fileFichJustificatif);
                    $absence->setUser($user);
                    $em->persist($absence);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('justifier', 'Votre justification a été pris en compte');
                    return $this->redirectToRoute('absences');
                } else {
                    return $this->render('Gestion_Abs_IUTBM_Bundle:Default:addAbsence.html.twig', array(
                        'form' => $form->createView(),
                        'erreurDate' => 'La date de retour est censé être après la date de départ'
                    ));
                }

            }

        }

        return $this->render('Gestion_Abs_IUTBM_Bundle:Default:addAbsence.html.twig', array(
            'form' => $form->createView()
        ));

    }

}
