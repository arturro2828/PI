<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;

class DeleteProductController extends Controller {

    /**
     * @Route("/deleteProduct/{id}", name="deleteProduct")
     */
    public function deleteProductAction($id) {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        $pictureToDelete = $product->getPicture();
        $path = $this->container->getParameter('pictures_directory') . '/' . $pictureToDelete;
        if ($path) {
            unlink($path);
        }


        $em->remove($product);
        $em->flush();
        $this->addFlash('notice', 'Usunięto poprawanie ogłoszenie');

        return $this->redirectToRoute('user');
    }

}
