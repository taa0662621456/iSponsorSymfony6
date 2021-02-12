<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function index():Response
    {
    return $this->render('dashboard/index.html.twig');
    }

    /**
    * @Route("/sponsor", name="sponsor", methods={"GET"})
    * @return void
    */
    public function sponsor(): void
    {
    // Dashboard
    }

    /**
    * @Route("/author", name="author", methods={"GET"})
    * @return void
    */
    public function author(): void
    {
    // Dashboard
    }
}
