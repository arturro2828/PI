<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{
    /**
     * @Route("/user", name="user")
     */
    
    public function userAction(){
        
      
        return new Response('<html><body>User page!</body></html>');
    }

    
}
