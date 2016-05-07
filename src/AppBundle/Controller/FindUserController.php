<?php

// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FindUserController extends Controller {

    /**
     * @Route("/users" , name="users")
     */
    public function newAction(Request $request) {

        
        $form = $this->createForm('AppBundle\Form\Type\FormType');
        $form->handleRequest($request);


        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        return $this->render('default/users.html.twig', [
                    'form' => $form->createView(), 'users' => $users]
        );
    }

}
