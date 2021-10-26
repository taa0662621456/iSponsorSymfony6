<?php

namespace App\Controller\Menu;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/career", name="career", methods={"GET"})
     */
    public function career()
    {
        return $this->render('menu/career.html.twig', array(
            'controller_name' => 'MenuController'
            )
        );
    }

    /**
     * @Route("/teame", name="teame", methods={"GET"})
     */
    public function teame()
    {
        return $this->render('menu/teame.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/general", name="general", methods={"GET"})
     */
    public function general()
    {
        return $this->render('menu/general.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/licensesearch", name="licensesearch", methods={"GET"})
     */
    public function licensesearch()
    {
        return $this->render('menu/licensesearch.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/confidenctial", name="confidenctial", methods={"GET"})
     */
    public function confidenctial()
    {
        return $this->render('menu/confidenctial.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/companydetails", name="companydetails", methods={"GET"})
     */
    public function companydetails()
    {
        return $this->render('company-detail.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/agreement", name="agreement", methods={"GET"})
     */
    public function agreement()
    {
        return $this->render('menu/agreement.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/forsale", name="forsale", methods={"GET"})
     */
    public function forsale()
    {
        return $this->render('menu/forsale.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }

    /**
     * @Route("/forsupply", name="forsupply", methods={"GET"})
     */
    public function forsupply()
    {
        return $this->render('menu/forsupply.html.twig', array(
            'controller_name' => 'MenuController'
        )
        );
    }
}
