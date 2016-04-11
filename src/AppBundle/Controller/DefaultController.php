<?php

// src/AppBundle/Controller/DefaultController.php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\FormType;

class DefaultController extends Controller {

    /**
     * @Route("/logowanie")
     */
    public function newAction(Request $request) {

        $user = new User();
        $form = $this->createForm('AppBundle\Form\Type\FormType', $user);
        $form->handleRequest($request);
        
        
        
        if ( ($form->get('save')->isClicked())) {

            $user = $form->getData();

            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            if ($repository->findBy(array('Name' => $user->getName()))) {

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

        if ( ($form->get('saveAndAdd')->isClicked())) {

            $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
            return $this->render('default/users.html.twig', [
                        'form' => $form->createView(), 'users' => $users]
            );
        }

        if ( ($form->get('saveAndAdd1')->isClicked())) {

            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $user = $repository->findOneBy(['Name' => $user->getName()]);

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
