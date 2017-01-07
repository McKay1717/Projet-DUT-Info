<?php

namespace Gestion_Abs_IUTBM_Bundle\Controller;

use DateTime;
use Gestion_Abs_IUTBM_Bundle\Entity\Abscence;
use Gestion_Abs_IUTBM_Bundle\Form\AbscenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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

        $security = $this->get('security.token_storage');
        $token = $security->getToken();
        $user = $token->getUser();

        $em = $this->getDoctrine()->getManager();
        $absences = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->findBy(array('user' => $user));

        if ($request->getMethod() == "POST") {
            $id = $request->get('absence');
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

        $session = $request->getSession();
        $id = $session->get('absence');
        $absences = new Abscence();
        $em = $this->getDoctrine()->getManager();
        $absence = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->find($id);
        $form = $this->createForm(AbscenceType::class, $absences);
        $debutAbs = $absence->getDebutAbs()->format('d/m/Y (H:i)');

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            //var_dump($form->getData()); die;

            if ($form->isValid()) {

                $finAbs = $form->getData()->getFinAbs();
                $fileFichJustificatif = $form->getData()->getFileFichJustificatif();


                if ($debutAbs < $finAbs) {
                    $absence = $em->getRepository('Gestion_Abs_IUTBM_Bundle:Abscence')->find($id);
                    $absence->setFinAbs($finAbs);
                    $absence->setFileFichJustificatif($fileFichJustificatif);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('justifier', 'Votre justification a été pris en compte');
                    return $this->redirectToRoute('absences');
                } else {
                    return $this->render('Gestion_Abs_IUTBM_Bundle:Default:justificatif.html.twig', array(
                        'form' => $form->createView(),
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

}
