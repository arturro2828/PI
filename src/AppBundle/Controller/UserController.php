<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/user", name="user")
     */
    public function userAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->getAllQuery(), $request->get('page', 1));
        return $this->render('default/strona/userPage.html.twig', ['pagination' => $pagination]);
    }

}
