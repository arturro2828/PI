<?php

// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\FormType;

class FindUserController extends Controller {

    /**
     * @Route("/users" , name="users")
     */
    public function newAction(Request $request) {

        $user = new User();
        $form = $this->createForm('AppBundle\Form\Type\FormType');
        //$form = $this->createForm('AppBundle\Form\Type\FormType', $user);
        $form->handleRequest($request);
         

      //  if ( ($form->get('saveAndAdd')->isClicked())) {

            $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
            return $this->render('default/users.html.twig', [
                        'form' => $form->createView(), 'users' => $users]
            );
     //   }

      
    }

}