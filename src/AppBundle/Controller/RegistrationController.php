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
        $form = $this->createForm('AppBundle\Form\Type\RegisterType', $user);
        $form->handleRequest($request);

        //$form->isSubmitted() && $form->isValid()


        if ($form->isValid()) {
            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            if ($repository->findBy(array('username' => $user->getUsername()))) {

                return new Response(
                        '<html><body>Jest taki user. Podaj innego</body></html>'
                );
            } else {
                $groupRepository = $this->getDoctrine()->getRepository('AppBundle:Group');
                $groupName = $this->getParameter('user_group_name');
                $userGroup = $groupRepository->getGroupByName($groupName);
                $user->addGroup($userGroup);

                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();


                $message = \Swift_Message::newInstance()
                        ->setSubject('Kod aktywacyjny')
                        ->setFrom('send@example.com')
                        ->setTo($user->getEmail())
                        ->setContentType('text/html')
                        ->setBody(
                        $this->renderView('default/emailMessages/activatingCode.html.twig', [
                            'form' => $form->createView(), 'users' => $user]
                ));
                $this->get('mailer')->send($message);


                $this->addFlash('notice', 'W celu potwierdzenia rejestracji odbierz maila i kliknij na link aktywacyjny');

                return $this->redirectToRoute('login');
            }
        } else {
            return $this->render('default/form.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

}
