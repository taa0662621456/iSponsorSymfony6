<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterLinkController extends AbstractController
{
    #[Route(path: '/owner', name: 'owner', methods: ['GET'])]
    public function owner() : Response
    {
        return $this->render('footer/owner.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/instructions', name: 'instructions', methods: ['GET'])]
    public function instructions() : Response
    {
        return $this->render('footer/instructions.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/career', name: 'career', methods: ['GET'])]
    public function career() : Response
    {
        return $this->render('footer/career.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/team', name: 'team', methods: ['GET'])]
    public function team() : Response
    {
        return $this->render('footer/team.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/general', name: 'general', methods: ['GET'])]
    public function general() : Response
    {
        return $this->render('footer/general.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/license', name: 'license', methods: ['GET'])]
    public function license() : Response
    {
        return $this->render('footer/license.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/confidential', name: 'confidential', methods: ['GET'])]
    public function confidential() : Response
    {
        return $this->render('footer/confidential.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/detail', name: 'detail', methods: ['GET'])]
    public function detail() : Response
    {
        return $this->render('footer/detail.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/agreement', name: 'agreement', methods: ['GET'])]
    public function agreement() : Response
    {
        return $this->render('footer/agreement.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/sale', name: 'sale', methods: ['GET'])]
    public function sale() : Response
    {
        return $this->render('footer/sale.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }

    #[Route(path: '/supply', name: 'supply', methods: ['GET'])]
    public function supply() : Response
    {
        return $this->render('footer/supply.html.twig', [
            'controller_name' => 'MenuController'
            ]
        );
    }
}
