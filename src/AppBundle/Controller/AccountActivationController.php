<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccountActivationController extends Controller {

    /**
     * @Route("/aktywacja/{id}/{emailCode}", name="accuntActivation")
     */
    public function accountActivation(Request $request, $id) {


        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($id);

        $user->setIsActive(true);
        $em->persist($user);
        $em->flush();



        if ($request->get('emailCode') == $user->getEmailCode()) {

            $message = \Swift_Message::newInstance()
                    ->setSubject('Potwierdzenie rejestracji w serwisie ogłoszeniowym')
                    ->setFrom('send@example.com')
                    ->setTo($user->getEmail())
                    ->setContentType('text/html')
                    ->setBody(
                    $this->renderView('default/emailMessages/registrationSuccess.html.twig', [
                        'users' => $user]
            ));
            $this->get('mailer')->send($message);
            return new Response(
                    '<html><body>Konto zostało aktywowane</body></html>'
            );
           
        } else {

            return new Response(
                    '<html><body>Podałeś błędny kod aktywacji</body></html>'
            );
        }
    }

}
