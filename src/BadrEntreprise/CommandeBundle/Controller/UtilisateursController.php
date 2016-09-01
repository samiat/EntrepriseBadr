<?php

namespace BadrEntreprise\CommandeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BadrEntreprise\CommandeBundle\Entity\Utilisateurs;
use BadrEntreprise\CommandeBundle\Form\UtilisateursType;

/**
 * Utilisateurs controller.
 *
 * @Route("/utilisateurs")
 */
class UtilisateursController extends Controller
{
    /**
     * Lists all Utilisateurs entities.
     *
     * @Route("/", name="utilisateurs_index")
     * @Method("GET")
     */
   
   public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('BadrEntrCommandeBundle:Utilisateurs')->findAll();

        return $this->render('utilisateurs/index.html.twig', array(
            'utilisateurs' => $utilisateurs,
        ));
    }
 /**
     * connect a Utilisateurs.
     *
     * @Route("/seConnecter", name="utilisateurs")
     * @Method({"GET", "POST"})
     */
	public function seConnecterAction ($email,$motDePasse)
	{
		$em = $this->getDoctrine()->getManager();
		
	}
    /**
     * Creates a new Utilisateurs entity.
     *
     * @Route("/new", name="utilisateurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm('BadrEntreprise\CommandeBundle\Form\UtilisateursType', $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('utilisateurs_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateurs/new.html.twig', array(
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Utilisateurs entity.
     *
     * @Route("/{id}", name="utilisateurs_show")
     * @Method("GET")
     */
    public function showAction(Utilisateurs $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);

        return $this->render('utilisateurs/show.html.twig', array(
            'utilisateur' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utilisateurs entity.
     *
     * @Route("/{id}/edit", name="utilisateurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Utilisateurs $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $editForm = $this->createForm('BadrEntreprise\CommandeBundle\Form\UtilisateursType', $utilisateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('utilisateurs_edit', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateurs/edit.html.twig', array(
            'utilisateur' => $utilisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Utilisateurs entity.
     *
     * @Route("/{id}", name="utilisateurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Utilisateurs $utilisateur)
    {
        $form = $this->createDeleteForm($utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateurs_index');
    }

    /**
     * Creates a form to delete a Utilisateurs entity.
     *
     * @param Utilisateurs $utilisateur The Utilisateurs entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisateurs $utilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateurs_delete', array('id' => $utilisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
