<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Entity\GroupRepository;


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

              //  var_dump($user);
              //  die;
                return new Response(
                        '<html><body>Jest taki user. Podaj innego</body></html>'
                );
            } else {
              $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');
               $groupName = $this->getParameter('user_group_name');
               $userGroup = $groupRepository->getGroupByName($groupName);
               $user->addGroup($userGroup);
           
               // var_dump($groupRepository);
               // die;
               //
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
