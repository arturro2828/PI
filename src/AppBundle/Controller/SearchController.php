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

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->generalSearch($request->get('searchEngine')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchElectronics", name="searchElectronics")
     */
    public function SearchElectronicsAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Elektronika')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchWFashion", name="searchWFashion")
     */
    public function SearchWFashionAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Moda Damska')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchMFashion", name="searchMFashion")
     */
    public function SearchMFashionAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Moda Męska')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchHandG", name="searchHandG")
     */
    public function SearchHandGAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Dom i ogród')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchSport", name="searchSport")
     */
    public function SearchSportAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Sport')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route("/searchMotors", name="searchMotors")
     */
    public function SearchMotorsAction(Request $request) {

        $paginator = $this->get('knp_paginator');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $pagination = $paginator->paginate($repository->findBy(array('category' => 'Motoryzacja')), $request->get('page', 1));
        return $this->render('default/strona/strona.html.twig', ['pagination' => $pagination]);
    }

}
