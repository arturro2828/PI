<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LogoutSuccessController extends Controller {

    /**
     * @Route("/logout=success")
     */
    
    public function logoutAction(Request $request) {

        return $this->render('default/security/logout.html.twig');
    }

}



    
    