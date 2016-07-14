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
       
    public function logInAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);
        
        
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
        
    }
}