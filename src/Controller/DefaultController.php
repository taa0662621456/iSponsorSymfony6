<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\FeaturedRepository;
use App\Repository\ProductsRepository;
use App\Repository\ProjectsRepository;
use App\Repository\TagsRepository;
use Symfony\Component\HttpFoundation\Request;
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
	 * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="homepage_rss")
	 * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="homepage_paginated")
	 * @param Request              $request
	 * @param string               $_format
	 * @param CategoriesRepository $categoriesRepository
	 * @param ProjectsRepository   $projectsRepository
	 * @param ProductsRepository   $productsRepository
	 * @param FeaturedRepository   $featuredRepository
	 * @param TagsRepository       $tags
	 *
	 * @return Response
	 */
    public function index(Request $request, string $_format, CategoriesRepository $categoriesRepository, ProjectsRepository $projectsRepository, ProductsRepository $productsRepository, FeaturedRepository $featuredRepository, TagsRepository $tags): Response
    {
        return $this->render('homepage/homepage.html.twig', array(
            'categories' => $categoriesRepository->findOneBy(['published' => true], ['id' => 'ASC']),
            'latest_project' => $projectsRepository->findBy([], ['createdOn' => 'DESC'], 12, null),
            'latest_products' => $productsRepository->findBy([], ['createdOn' => 'DESC'], 12, null),
            'featured_projects' => $featuredRepository->findBy(['type' => 'J'], ['order' => 'DESC'], 12, null),
            'featured_products' => $featuredRepository->findBy(['type' => 'D'], ['order' => 'DESC'], 12, null),
            'featured_categories' => $featuredRepository->findBy(['type' => 'C'], ['order' => 'DESC'], 12, null),
            'featured_vendors' => $featuredRepository->findBy(['type' => 'V'], ['order' => 'DESC'], 12, null)
		));
    }
}