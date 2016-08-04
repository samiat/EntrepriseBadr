<?php

namespace BadrEntreprise\CommandeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use BadrEntreprise\CommandeBundle\Entity\Produit;
use BadrEntreprise\CommandeBundle\Repository\ProduitRepository;



class PanierController extends Controller
{


 public function indexAction()
  {
$repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('BadrEntrCommandeBundle:Produit')
;

$listArticles = $repository->findAll();
return $this->render('BadrEntrCommandeBundle:Panier:index.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listArticles' => $listArticles
    ));
  }
  
   // pour tester cette méthode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/passer
  public function passerAction()
  {
    return new Response("vous avez passer une commande !");
  }
  
  // pour tester cette méthode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/supprimer/1
  public function supprimerAction($id)
  {
    return new Response("vous avez supprimer l'article ".$id ." de votre panier");
  }
  
  
  // On injecte la requête dans les arguments de la méthode
  // pour tester cette méthode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/afficher/1?tag=soufiane
   public function afficherAction($id, Request $request)
  {
  if ($request->isMethod('POST'))
	{
	// Un formulaire a été envoyé, on peut le traiter ici
	}
if ($request->isXmlHttpRequest())
	{
	// C'est une requête AJAX, retournons du JSON, par exemple
	}
  // On récupère notre paramètre tag
    $tag = $request->query->get('tag');
	return new Response("vous avez afficher l'article ".$id ." depuis votre panier avec le tag : ".$tag);
  }
  
  // pour tester cette méthode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/afficherAutrePage/1
   public function afficherAutrePageAction($id)
  {
 
	return $this->redirectToRoute('badr_entr_commande_supprimer', array('id' => $id));
    
  }
  
  // On injecte la requête dans les arguments de la méthode
  // pour tester cette méthode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/persisterProduit
   public function  persisterProduitAction(Request $request){
  
  
	$produit1 = new Produit();
	$produit1->setTitre('Pantalon 1');
	$produit1->setPrix(24);
	$produit2 = new Produit();
	$produit2->setTitre('Pantalon 2');
	$produit2->setPrix(30);
	global $listArticles;
	$listArticles = array($produit1, $produit2);
	 // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Étape 1 : On « persiste » l'entité
    $em->persist($produit1);
	$em->persist($produit2);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
	
	return $this->render('BadrEntrCommandeBundle:Panier:index.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listArticles' => $listArticles
    ));
  
  }
  
}