<?php

namespace BadrEntreprise\CommandeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BadrEntreprise\CommandeBundle\Entity\Couleur;
use BadrEntreprise\CommandeBundle\Form\CouleurType;

/**
 * Couleur controller.
 *
 * @Route("/couleur")
 */
class CouleurController extends Controller
{
    /**
     * Lists all Couleur entities.
     *
     * @Route("/", name="couleur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $couleurs = $em->getRepository('BadrEntrCommandeBundle:Couleur')->findAll();

        return $this->render('couleur/index.html.twig', array(
            'couleurs' => $couleurs,
        ));
    }

    /**
     * Creates a new Couleur entity.
     *
     * @Route("/new", name="couleur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $couleur = new Couleur();
        $form = $this->createForm('BadrEntreprise\CommandeBundle\Form\CouleurType', $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($couleur);
            $em->flush();

            return $this->redirectToRoute('couleur_show', array('id' => $couleur->getId()));
        }

        return $this->render('couleur/new.html.twig', array(
            'couleur' => $couleur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Couleur entity.
     *
     * @Route("/{id}", name="couleur_show")
     * @Method("GET")
     */
    public function showAction(Couleur $couleur)
    {
        $deleteForm = $this->createDeleteForm($couleur);

        return $this->render('couleur/show.html.twig', array(
            'couleur' => $couleur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Couleur entity.
     *
     * @Route("/{id}/edit", name="couleur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Couleur $couleur)
    {
        $deleteForm = $this->createDeleteForm($couleur);
        $editForm = $this->createForm('BadrEntreprise\CommandeBundle\Form\CouleurType', $couleur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($couleur);
            $em->flush();

            return $this->redirectToRoute('couleur_edit', array('id' => $couleur->getId()));
        }

        return $this->render('couleur/edit.html.twig', array(
            'couleur' => $couleur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Couleur entity.
     *
     * @Route("/{id}", name="couleur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Couleur $couleur)
    {
        $form = $this->createDeleteForm($couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($couleur);
            $em->flush();
        }

        return $this->redirectToRoute('couleur_index');
    }

    /**
     * Creates a form to delete a Couleur entity.
     *
     * @param Couleur $couleur The Couleur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Couleur $couleur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('couleur_delete', array('id' => $couleur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
