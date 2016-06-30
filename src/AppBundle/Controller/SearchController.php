<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchController extends Controller {

    /**
     * @Route("/searchEngine", name="searchEngine")
     */
    public function SearchEngineAction(Request $request) {

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->search1($request->get('searchEngine'));
        return $this->render('default/strona/strona.html.twig', [
                    'products' => $products]
        );
    }

    /**
     * @Route("/searchElectronics", name="searchElectronics")
     */
    public function SearchElectronicsAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Elektronika'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    /**
     * @Route("/searchWFashion", name="searchWFashion")
     */
    public function SearchWFashionAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Moda Damska'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    /**
     * @Route("/searchMFashion", name="searchMFashion")
     */
    public function SearchMFashionAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Moda Męska'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    /**
     * @Route("/searchHandG", name="searchHandG")
     */
    public function SearchHandGAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Dom i ogród'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    /**
     * @Route("/searchSport", name="searchSport")
     */
    public function SearchSportAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Sport'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

    /**
     * @Route("/searchMotors", name="searchMotors")
     */
    public function SearchMotorsAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\Type\ProductType');
        $form->handleRequest($request);

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')
                ->findBy(array('category' => 'Motoryzacja'));
        return $this->render('default/strona/strona.html.twig', [
                    'form' => $form->createView(), 'products' => $products]
        );
    }

}
