<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;
use AppBundle\Entity\GroupRepository;

class EditProductController extends Controller {

    /**
     * @Route("/editProduct/{id}", name="editProduct")
     */
    public function newEditProductAction(Request $request,$id) {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);
        $form = $this->createForm('AppBundle\Form\Type\EditProductType', $product);
        
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
           
            
            $editDateNew = new \DateTime();
            $product->setEditDate($editDateNew);
            
            $em->persist($product);
            $em->flush();

           
            
            
            $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();
        return $this->render('default/strona/userPage.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
        } else {
            return $this->render('default/editProductForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

}