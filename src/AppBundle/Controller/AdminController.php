<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller{
     
    /**
     * @Route("/admin", name="admin")
     */
    
    
    public function adminAction(){
        
      
        return new Response('<html><body>Admin page!</body></html>');
    }

}






    
        
        