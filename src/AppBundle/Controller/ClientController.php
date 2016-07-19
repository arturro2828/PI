<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Product;

class ClientController extends Controller {

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

            $this->addFlash('notice', 'Dodano ogłoszenie');

            return $this->redirectToRoute('user');
        } else {
            return $this->render('default/addProductForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

    /**
     * @Route("/editProduct/{id}", name="editProduct")
     */
    public function newEditProductAction(Request $request, $id) {

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

            $this->addFlash('notice', 'Ogłoszenie zostało poprawanie zmienione');

            return $this->redirectToRoute('user');
        } else {
            return $this->render('default/editProductForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

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

    /**
     * @Route("/editUser/{id}", name="editUser")
     */
    public function newEditUserAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $form = $this->createForm('AppBundle\Form\Type\EditUserType', $user);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $addDateNewUser = new \DateTime();
            $user->setEditDate($addDateNewUser);

            $em->persist($user);
            $em->flush();

            $this->addFlash('notice', 'Zmodyfikowano dane użytkownika');

            return $this->redirectToRoute('user');
        } else {
            return $this->render('default/editUserForm.html.twig', [
                        'form' => $form->createView(),]
            );
        }
    }

    /**
     * @Route("/deleteAccount/{id}", name="deleteAccount")
     */
    public function deleteAccountAction($id) {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);


        $em->remove($user);
        $em->flush();

        $this->get('security.token_storage')->setToken(null);
        return $this->redirectToRoute('logout');
    }

}
