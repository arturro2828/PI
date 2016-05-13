<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller{
     
    /**
     * @Route("/admin", name="admin")
     */
    
    
    public function newAction(Request $request) {

        
        $form = $this->createForm('AppBundle\Form\Type\RegisterType');
        $form->handleRequest($request);


       // $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        return $this->render('default/strona/adminPage.html.twig', [
                    'form' => $form->createView(), 'users' => $users]
        );
    }

}






    
        
        