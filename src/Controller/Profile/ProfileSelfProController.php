<?php
declare(strict_types=1);

namespace App\Controller\Profile;

use App\Repository\OrdersRepository;
use App\Repository\ProductsRepository;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/self")
 */
class ProfileSelfProController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     * @return array
     */
    public function index(): array
    {
        return [];

    }

    /**
     * @Route("/projects", name="projects", methods={"GET"})
     * @param ProjectsRepository $projectsRepository
     * @return Response
     */
    public function projects(ProjectsRepository $projectsRepository): Response
    {
        return $this->render('projects/index.html.twig', array(
            'projects' => $projectsRepository->findBy(
                array('createdBy' => $this->getUser())
            ),
        ));
    }

    /**
     * @Route("/products", name="products", methods={"GET"})
     * @param ProductsRepository $productsRepository
     * @return Response
     */
    public function products(ProductsRepository $productsRepository): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $productsRepository->findBy(
                array('createdBy' => $this->getUser())
            ),
        ]);
    }

    /**
     * @Route("/orders", name="orders", methods={"GET"})
     * @param OrdersRepository $ordersRepository
     * @return Response
     */
    public function orders(OrdersRepository $ordersRepository): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $ordersRepository->findBy(
                array('createdBy' => $this->getUser())
            ),
        ]);
    }    
    


}
