<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller{
    /**
     * @Route("/user", name="user")
     */
    
    public function userAction(Request $request){
        
      
         $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);


      

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('default/strona/userPage.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    
}
