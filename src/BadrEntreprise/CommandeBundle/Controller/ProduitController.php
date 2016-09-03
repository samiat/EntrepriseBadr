<?php

namespace BadrEntreprise\CommandeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BadrEntreprise\CommandeBundle\Entity\Produit;
use BadrEntreprise\CommandeBundle\Entity\Couleur;
use BadrEntreprise\CommandeBundle\Form\ProduitType;

/**
 * Produit controller.
 *
 * @Route("/produit")
 */
class ProduitController extends Controller
{
    /**
     * Lists all Produit entities.
     *
     * @Route("/", name="produit_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
		
		$session = $request->getSession();
		$isAdmin = false;
		$session->set('isAdmin' , $isAdmin);
			
        $em = $this->getDoctrine()->getManager();
		
		$session = $request->getSession();
		$produits = $session->get('$produits');
		$nombrearticle = $session->get('$nombrearticle');

        $produits = $em->getRepository('BadrEntrCommandeBundle:Produit')->findAll();

        return $this->render('produit/index.html.twig', array(
            'produits' => $produits,
			'nombrearticle' => $nombrearticle,
        ));
    }

 /**
     * Lists all Produit entities.
     *
     * @Route("/addquantite", name="produit_addquantite")
     * @Method("GET")
     */
    public function addquantiteAction(Request $request)
    {
		
		$session = $request->getSession();
		$isAdmin = false;
		$session->set('isAdmin' , $isAdmin);
			
        $em = $this->getDoctrine()->getManager();
		
		$session = $request->getSession();
		$produitsInPanier = $session->get('$produits');
		$nombrearticle = $session->get('$nombrearticle');

        $produits = $em->getRepository('BadrEntrCommandeBundle:Produit')->findAll();

        return  $this->render('produit/addquantite.html.twig', array(
            'produits' => $produits,
			'nombrearticle' => $nombrearticle,
        ));
    }
	
 /**
     * Lists all Produit in Panier.
     *
     * @Route("/panier", name="show_panier")
     * @Method("GET")
     */
    public function showPanierAction(Request $request)
    {
	
		$session = $request->getSession();
		$produits = $session->get('$produits');
		$prixtotal = $session->get('$prixtotal');
		$nombrearticle = $session->get('$nombrearticle');
		

        return $this->render('produit/panier.html.twig', array(
            'produits' => $produits,
			'prixtotal' => $prixtotal,
			'nombrearticle' => $nombrearticle,
			
        ));
    }

    /**
     * Creates a new Produit entity.
     *
     * @Route("/new", name="produit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
		$couleur = new Couleur();
		$produit->getCouleurs()->add($couleur);
	    $form = $this->createForm('BadrEntreprise\CommandeBundle\Form\ProduitType', $produit );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_addquantite');
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produit entity.
     *
     * @Route("/{id}", name="produit_show")
     * @Method("GET")
     */
    public function showAction(Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('produit/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produit entity.
     *
     * @Route("/{id}/edit", name="produit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('BadrEntreprise\CommandeBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_edit', array('id' => $produit->getId()));
        }

        return $this->render('produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produit entity.
     *
     * @Route("/{id}/delete", name="produit_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Produit $produit)
    {
       
	    $session = $request->getSession();
	
		if($session->has('$produits'))
		{
			$produits = $session->get('$produits');
			$prixtotal = $session->get('$prixtotal');
			$nombrearticle = $session->get('$nombrearticle');
			
			if(array_key_exists($produit->getId(), $produits)) {
				unset($produits[$produit->getId()]);
				$prixtotal = $prixtotal - $produit->getPrix();
				$nombrearticle = $nombrearticle-1;
            }
			$session->set('$produits' , $produits);
			$session->set('$prixtotal' , $prixtotal);
			$session->set('$nombrearticle' , $nombrearticle);
		}
		
        return $this->redirectToRoute('show_panier');
    }

    /**
     * Creates a form to delete a Produit entity.
     *
     * @param Produit $produit The Produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
	
	
	/**
     * Displays a form to edit an existing Produit entity.
     *
     * @Route("/panier/{id}", name="produit_panier")
     * @Method({"GET", "POST"})
     */
    public function panierAction(Request $request, Produit $produit)
    {
		
       $session = $request->getSession();
		
		if(!$session->has('$produits'))
		{
				
				$prixtotal = $produit->getPrix();
				$produits = array();
				$nombrearticle = 1;
				$produits[$produit->getId()] = $produit;
				$session->set('$produits' , $produits);
				$session->set('$prixtotal' , $prixtotal);
				$session->set('$nombrearticle' , $nombrearticle);
		}
			else
		{
			$produits = $session->get('$produits');
			$nombrearticle = count($produits);
			$prixtotal = $session->get('$prixtotal');
			$produits[$produit->getId()] = $produit;
			$prixtotal = $prixtotal + $produit->getPrix();
			$session->set('$produits' , $produits);
			$session->set('$prixtotal' , $prixtotal);
			$session->set('$nombrearticle' , $nombrearticle);
			
		}
		
        return $this->redirectToRoute('produit_index');
    }
}
