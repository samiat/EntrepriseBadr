<?php
// src/BadrEntreprise/UserBundle/Controller/SecurityController.php;

namespace BadrEntreprise\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BadrEntreprise\CommandeBundle\Controller\ProduitController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    // Si le visiteur est d�j� identifi�, on le redirige vers l'accueil
    
    
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	return $this->redirectToRoute('badr_entr_commande_produit');
}
    
    // Le service authentication_utils permet de r�cup�rer le nom d'utilisateur
    // et l'erreur dans le cas o� le formulaire a d�j� �t� soumis mais �tait invalide
    // (mauvais mot de passe par exemple)
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('BadrEntrepriseUserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }

  
  
}