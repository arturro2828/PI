<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\Type\PageType;

class PageController extends Controller {

    /**
     * @Route("/")
     */
       
    public function logInAction() {

        
          
            return $this->render('default/strona/strona.html.twig');
        
    }
}