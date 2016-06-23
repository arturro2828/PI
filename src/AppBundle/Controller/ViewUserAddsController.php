<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ViewUserAddsController extends Controller{
    
    /**
     * @Route("/viewUserAdds/{id}", name="viewUserAdds")
     */
      public function viewUserAddsAction(Request $request) {
    $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);


       

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('default/users.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
}
}