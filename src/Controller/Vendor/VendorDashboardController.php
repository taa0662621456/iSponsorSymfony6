<?php


namespace App\Controller\Vendor;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/vendor/dashboard')]
#[Route(path: '/sponsor/dashboard')]
class VendorDashboardController extends AbstractController
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

    public function edit()
    {

    }

    public function add()
    {

    }

    public function delete()
    {

    }
}
