<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;


class DeleteAccountController extends Controller {
    /**
     * @Route("/deleteAccount", name="deleteAccount")
     */
    
    public function deleteAccountAction(Request $request) {
        
        $user = new User();
        $form = $this->createForm('AppBundle\Form\Type\RegisterType', $user);
        $form->handleRequest($request);
        
        
        
        if ( ($form->get('RegisterButton')->isClicked()) ) {

            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $repository->findOneBy(['username' => $user->getUsername()]);

            if ($user) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();

                return $this->render('default/delateUserSuccess.html.twig', [
                            'form' => $form->createView(), 'users' => $user]
                );
            }
        } else {
            return $this->render('default/form.html.twig', [
                        'form' => $form->createView(),]
            );
        }
        
    }
     
}
