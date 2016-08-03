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
    // on la récupérera depuis la BDD !
    $listArticles = array(
      array('id' => 2, 'title' => 'Pantalon 2'),
      array('id' => 5, 'title' => 'Chemise 5'),
      array('id' => 9, 'title' => 'Sac 9')
    );

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
  
}