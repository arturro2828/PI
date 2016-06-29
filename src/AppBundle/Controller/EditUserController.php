<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Entity\GroupRepository;

class EditUserController extends Controller {

    /**
     * @Route("/editUser/{id}", name="editUser")
     */
    public function newEditUserAction(Request $request,$id) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $form = $this->createForm('AppBundle\Form\Type\EditUserType', $user);
        $form->handleRequest($request);
         
        if ($form->isValid()) {

            $em->persist($user);
            $em->flush();

            $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('default/strona/userPage.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
        } else {
            return $this->render('default/editUserForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

}
