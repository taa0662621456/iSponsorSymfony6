<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/dashboard')]
class DashboardController extends AbstractController
{
    #[Route(path: '/')]
    public function index() : Response
    {
        return $this->render('dashboard/index.html.twig');
    }
    #[Route(path: '/sponsor', name: 'sponsor', methods: ['GET'])]
    public function sponsor() : void
    {
        // Dashboard
    }
    #[Route(path: '/author', name: 'author', methods: ['GET'])]
    public function author() : void
    {
        // Dashboard
    }
}
