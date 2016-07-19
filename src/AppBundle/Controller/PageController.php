<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class PageController extends Controller {

    /**
     * @Route("/")
     */
       
    public function PageDisplayingAction(Request $request) {
        
        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->getAllQuery(), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
       
    }
}