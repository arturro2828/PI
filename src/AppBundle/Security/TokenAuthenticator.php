<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthenticator extends AbstractGuardAuthenticator {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getCredentials(Request $request) {

        if (!$request->request->get('_username')) {
            return null;
        } else {
            return array(
                'username' => $request->request->get('_username'),
                'password' => $request->request->get('_password'),
            );
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider) {
        $loginUser = $credentials['username'];



        $dbUser = $this->em->getRepository('AppBundle:User')
                ->findOneBy(array('username' => $loginUser));


        // if null, authentication will fail
        // if a User object, checkCredentials() is called
        return $dbUser;
    }

    public function checkCredentials($credentials, UserInterface $dbUser) {

        if ( ($dbUser->getIsActive())) {
            
        return true;
        
        }
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        
        return new Response(
                        '<html><body>Konto nie jest aktywne</body></html>'
                );
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null) {
        $data = array(
            // you might translate this message
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, 401);
    }

    public function supportsRememberMe() {
        return false;
    }

}
