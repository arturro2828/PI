<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;
class AddProductController extends Controller {
    /**
     * @Route("/addProduct", name="addProduct")
     */
    public function AddProductAction(Request $request) {
       $this->denyAccessUnlessGranted('ROLE_USER', null, 'Nie masz uprawnień, żeby wejść na tą stronę!');
      
        
        $product = new Product();
        $form = $this->createForm('AppBundle\Form\Type\ProductType', $product);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $product = $form->getData();
            $file = $product->getPicture();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                    $this->container->getParameter('pictures_directory'), $fileName);
            $imagine = new \Imagine\Gd\Imagine();
            $size = new \Imagine\Image\Box(100, 100);
            $mode = \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
            $image = $imagine->open($this->container->getParameter('pictures_directory') . '/' . $fileName)
                    ->thumbnail($size, $mode)
                    ->save($this->container->getParameter('pictures_directory') . '/' . $fileName);
            $product->setPicture($fileName);
            $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
            $em = $this->getDoctrine()->getManager();
           
            $addDateNew = new \DateTime();
            $product->setDueDate($addDateNew);
            $product->setEditDate($addDateNew);
            
            $em->persist($product);
            $em->flush();
            return $this->render('default/productSuccess.html.twig', [
                        'form' => $form->createView(), 'products' => $product]
            );
        } else {
            return $this->render('default/addProductForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }
}
