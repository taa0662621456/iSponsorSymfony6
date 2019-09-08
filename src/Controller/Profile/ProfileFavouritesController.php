<?php
declare(strict_types=1);

namespace App\Controller\Profile;

use App\Repository\ProductsRepository;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/favourites")
 */
class ProfileFavouritesController extends AbstractController
{
    /**
     * @Route("/projects", name="projects_favourites", methods={"GET"})
     * @param Request $request
     * @return array
     */
    public function projects(Request $request): array
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $projectsRepository = $em->getRepository(ProjectsRepository::class);
        $limit = $this->getParameter('products_pagination_count');

        $query = $projectsRepository->getFavouritesQB($this->getUser());

        $projects = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $limit
        );

        return ['projects' => $projects,
            'sortedby' => $this->get('app.page_utilities')->getSortingParamName($request)
        ];
    }

    /**
     * @Route("/products", name="projects_favourites", methods={"GET"})
     * @param Request $request
     * @return array
     */
    public function products(Request $request): array
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $productRepository = $em->getRepository(ProductsRepository::class);
        $limit = $this->getParameter('products_pagination_count');

        $query = $productRepository->getFavouritesQB($this->getUser());

        $products = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $limit
        );

        return ['products' => $products,
            'sortedby' => $this->get('app.page_utilities')->getSortingParamName($request)
        ];
    }

    /**
     * @Route("/sponsors", name="sponsors_favourites", methods={"GET"})
     * @param Request $request
     * @return array
     */
    public function sponsors(Request $request): array
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');
        $vendorsRepository = $em->getRepository(VendorsRepository::class);
        $limit = $this->getParameter('products_pagination_count');

        $query = $vendorsRepository->getFavouritesQB($this->getUser());

        $sponsors = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $limit
        );

        return ['sponsors' => $sponsors,
            'sortedby' => $this->get('app.page_utilities')->getSortingParamName($request)
        ];
    }
}