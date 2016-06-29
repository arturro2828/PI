<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;

class DeleteAccountController extends Controller {

    /**
     * @Route("/deleteAccount/{id}", name="deleteAccount")
     */
    public function deleteAccountAction($id) {
       
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        

//wyloguj
        
        
        
        $em->remove($user);
        $em->flush();
        $this->addFlash('notice', 'Usunięto poprawanie użytkownika');

        return $this->redirectToRoute('admin');
    }

}
