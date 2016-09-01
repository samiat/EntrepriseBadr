<?php

namespace BadrEntreprise\CommandeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use BadrEntreprise\CommandeBundle\Entity\Produit;
use BadrEntreprise\CommandeBundle\Repository\ProduitRepository;
use BadrEntreprise\CommandeBundle\Form\ProduitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
  
 $repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('BadrEntrCommandeBundle:Produit')
;

$produit = $repository->find($id);
	
// On crée le FormBuilder grâce au service form factory
$form = $this->createForm(ProduitType::class, $produit);
				
return $this->render('BadrEntrCommandeBundle:Panier:produit.html.twig',array('id' => $id,'form' => $form->createView()));
}

 public function seConnecterAction()
  {
  
 $repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('BadrEntrCommandeBundle:Utilisateurs')
;


	
// On crée le FormBuilder grâce au service form factory
$form = $this->createForm(seConnecterForm::class);
				
return $this->render('BadrEntrCommandeBundle:Panier:produit.html.twig',array('id' => $id,'form' => $form->createView()));
}
  
  // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/afficherPanier
   public function afficherPanierAction ($id, Request $request)
  {
  
 
	if ($request->getMethod() == 'POST')
{

 $repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('BadrEntrCommandeBundle:Produit')
;

$produit = $repository->find($id);
				
		
		$session = $request->getSession();
	
		if(!$session->has('listArticlesPanier'))
			{
				$listArticlesPanier = array();
				array_push($listArticlesPanier, $produit);
				$session->set('listArticlesPanier' , $listArticlesPanier);
			}
			else{
			$listArticlesPanier = $session->get('listArticlesPanier');
			array_push($listArticlesPanier,$produit);
			$session->set('listArticlesPanier' , $listArticlesPanier);
			}
		
			

return $this->render('BadrEntrCommandeBundle:Panier:panier.html.twig');

		

}
else{
die('ici la');
}

    
  }
  
  // On injecte la requ�te dans les arguments de la m�thode
  // pour tester cette m�thode : http://localhost/SymfonyProjetSamia/web/app_dev.php/panier/persisterProduit
   public function  persisterProduitAction(Request $request){
  
  
	$produit1 = new Produit();
	$produit1->setTitre('Pantalon 1');
	$produit1->setPrix(24);
	$produit2 = new Produit();
	$produit2->setTitre('Pantalon 2');
	$produit2->setPrix(30);
	global $listArticles;
	$listArticles = array($produit1, $produit2);
	 // On r�cup�re l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // �tape 1 : On � persiste � l'entit�
    $em->persist($produit1);
	$em->persist($produit2);

    // �tape 2 : On � flush � tout ce qui a �t� persist� avant
    $em->flush();
	
	return $this->render('BadrEntrCommandeBundle:Panier:index.html.twig', array(
      // Tout l'int�r�t est ici : le contr�leur passe
      // les variables n�cessaires au template !
      'listArticles' => $listArticles
    ));
  
  }
  
}
