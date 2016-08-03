<?php

namespace BadrEntreprise\CommandeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PanierController extends Controller
{
  public function indexAction()
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la r�cup�rera depuis la BDD !
    $listArticles = array(
      array('id' => 2, 'title' => 'Pantalon 2'),
      array('id' => 5, 'title' => 'Chemise 5'),
      array('id' => 9, 'title' => 'Sac 9')
    );

    return $this->render('BadrEntrCommandeBundle:Panier:index.html.twig', array(
      // Tout l'int�r�t est ici : le contr�leur passe
      // les variables n�cessaires au template !
      'listArticles' => $listArticles
    ));
  }
  
   // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/passer
  public function passerAction()
  {
    return new Response("vous avez passer une commande !");
  }
  
  // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/supprimer/1
  public function supprimerAction($id)
  {
    return new Response("vous avez supprimer l'article ".$id ." de votre panier");
  }
  
  
  // On injecte la requ�te dans les arguments de la m�thode
  // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/afficher/1?tag=soufiane
   public function afficherAction($id, Request $request)
  {
  if ($request->isMethod('POST'))
	{
	// Un formulaire a �t� envoy�, on peut le traiter ici
	}
if ($request->isXmlHttpRequest())
	{
	// C'est une requ�te AJAX, retournons du JSON, par exemple
	}
  // On r�cup�re notre param�tre tag
    $tag = $request->query->get('tag');
	return new Response("vous avez afficher l'article ".$id ." depuis votre panier avec le tag : ".$tag);
  }
  
  // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/afficherAutrePage/1
   public function afficherAutrePageAction($id)
  {
 
	return $this->redirectToRoute('badr_entr_commande_supprimer', array('id' => $id));
    
  }
  
}