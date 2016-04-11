<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;


class RegistrationController extends Controller {

    /**
     * @Route("/registration", name="registration")
     */
    public function RegisterAction(Request $request) {

    
        $user = new User();
        $form = $this->createForm('AppBundle\Form\Type\RegisterType',$user );
        $form->handleRequest($request);
        
       //$form->isSubmitted() && $form->isValid()
        
      
        if ( $form->isValid()) {

            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            if ($repository->findBy(array('username' => $user->getUsername()))) {

                return new Response(
                        '<html><body>Jest taki user. Podaj innego</body></html>'
                );
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->render('default/success.html.twig', [
                            'form' => $form->createView(), 'users' => $user]
                );
            }
        }
           
            else{
                return $this->render('default/form.html.twig', [
                        'form' => $form->createView(),]
            );  
            }
    }
}
