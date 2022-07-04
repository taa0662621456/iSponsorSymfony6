<?php

namespace App\Controller;

use App\Repository\Category\CategoryRepository;
use App\Repository\Featured\FeaturedRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\Project\ProjectRepository;
use DateInterval;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
    * @throws Exception
    */
    #[Route(path: '/', name: 'homepage', requirements: ['_locale' => '^[a-z]{2}$', '_local_filter' => '^[a-z]{2}$'], defaults: ['page' => 1, '_format' => 'html', '_locale' => 'en', '_local_filter' => 'en-gb'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'homepage_paginated', requirements: ['_locale' => '^[a-z]{2}$', '_local_filter' => '^[a-z]{2}$'], defaults: ['_format' => 'html'], methods: ['GET'])]
    public function index(CategoryRepository $categoriesRepository, ProjectRepository $projectsRepository, ProductRepository $productsRepository, FeaturedRepository $featuredRepository) : Response
    {
        $token = 'fgdfgFGDFGDFGdfdfdfgDFDFGDFG';
        //$userName = $this->getUser()->getUserIdentifier(); //TODO: getUserIdentifier()
        $userName = '$this->getUser()->getUserIdentifier()';
        $key = $this->getParameter('app_mercure_secret_key');
        $response = $this->render(
            'home/home.html.twig', [
            'categories' => $categoriesRepository->findAll(),
            //'categories' => $categoriesRepository->findOneBy(
            //  ['published' => 't'], ['id' => 'ASC']),
            'latest_projects' => $projectsRepository->findBy(
            [], ['createdAt' => 'ASC'], 12),
            'latest_products' => $productsRepository->findBy(
            [], ['createdAt' => 'ASC'], 12),
            'featured_projects' => $featuredRepository->findBy(
            ['featuredType' => 'J'], ['ordering' => 'ASC'], 12
            ),
            'featured_products' => $featuredRepository->findBy(
            ['featuredType' => 'D'], ['ordering' => 'ASC'], 12
            ),
            'featured_categories' => $featuredRepository->findBy(
            ['featuredType' => 'C'], ['ordering' => 'ASC'], 12
            ),
            'featured_vendors' => $featuredRepository->findBy(
            ['featuredType' => 'V'], ['ordering' => 'ASC'], 12
            )
            ]
        );
        $response->headers->setCookie(
            new Cookie(
            'mercureAuthorisation',
            $token,
            (new DateTime())
            ->add(new DateInterval('PT2H')),
            '/.well-know/mercure',
            null,
            false,
            true,
            false,
            'strict'
            )
        );
    return $response;
    }
}

