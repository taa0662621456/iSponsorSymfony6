<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\FeaturedRepository;
use App\Repository\ProductsRepository;
use App\Repository\ProjectsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{

	/**
	 * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="homepage")
	 * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="homepage_paginated")
	 * @param CategoriesRepository $categoriesRepository
	 * @param ProjectsRepository   $projectsRepository
	 * @param ProductsRepository   $productsRepository
	 * @param FeaturedRepository   $featuredRepository
	 *
	 * @return Response
	 */
    public function index(CategoriesRepository $categoriesRepository, ProjectsRepository $projectsRepository, ProductsRepository $productsRepository, FeaturedRepository $featuredRepository): Response
    {
        return $this->render('homepage/homepage.html.twig', array(
            'categories' => $categoriesRepository->findOneBy(['published' => true], ['id' => 'ASC']),
            'latest_project' => $projectsRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
            'latest_products' => $productsRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
            'featured_projects' => $featuredRepository->findBy(['type' => 'J'], ['order' => 'ASC'], 12, null),
            'featured_products' => $featuredRepository->findBy(['type' => 'D'], ['order' => 'ASC'], 12, null),
            'featured_categories' => $featuredRepository->findBy(['type' => 'C'], ['order' => 'ASC'], 12, null),
            'featured_vendors' => $featuredRepository->findBy(['type' => 'V'], ['order' => 'ASC'], 12, null)
		));
    }
}