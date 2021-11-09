<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FooterLinkController extends AbstractController
{
    /**
     * @Route("/career", name="career", methods={"GET"})
     */
    public function career(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/career.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/team", name="team", methods={"GET"})
     */
    public function team(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/team.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/general", name="general", methods={"GET"})
     */
    public function general(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/general.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/license", name="license", methods={"GET"})
     */
    public function license(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/license.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/confidential", name="confidential", methods={"GET"})
     */
    public function confidential(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/confidential.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/detail", name="detail", methods={"GET"})
     */
    public function detail(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/detail.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/agreement", name="agreement", methods={"GET"})
     */
    public function agreement(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/agreement.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/sale", name="sale", methods={"GET"})
     */
    public function sale(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/sale.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    /**
     * @Route("/supply", name="supply", methods={"GET"})
     */
    public function supply(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('footer/supply.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }
}
