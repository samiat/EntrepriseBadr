<?php

namespace BadrEntreprise\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BadrEntrBoutiqueBundle:Default:index.html.twig');
    }
}
