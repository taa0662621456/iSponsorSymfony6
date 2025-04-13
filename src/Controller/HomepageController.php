<?php

namespace App\Controller;

use App\Service\ObjectInitializer;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class HomepageController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private ObjectInitializer $objectInitializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        ObjectInitializer $objectInitializer,
    ) {
        $this->entityManager = $entityManager;
        $this->objectInitializer = $objectInitializer;

    }

    /**
     * @throws Exception
     */
    #[Route(path: '/', name: 'homepage', requirements: ['_locale' => '^[a-z]{2}$', '_local_filter' => '^[a-z]{2}-[a-zA-Z]{2}$'], defaults: ['page' => 1, '_format' => 'html', '_locale' => '%app_locale%', '_local_filter' => '%app_locale_filter%'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'homepage_paginated', requirements: ['_locale' => '^[a-z]{2}$', '_local_filter' => '^[a-z]{2}$'], defaults: ['_format' => 'html', '_locale' => '%app_locale%', '_local_filter' => '%app_locale_filter%'], methods: ['GET'])]
    public function index(): Response
    {
        $objects = ['Project', 'Product', 'Category', 'Featured', 'Vendor'];
        $repositories = [];

        foreach ($objects as $object) {
            $repositories[strtolower($object)] = $this->entityManager->getRepository(
                $this->objectInitializer->getObjectNamespace($object)
            );
        }

        $projects = $repositories['project']->findBy([], ['createdAt' => 'DESC'], 12);
        $products = $repositories['product']->findBy([], ['createdAt' => 'DESC'], 12);
        $featured = $repositories['featured']->findBy(['featuredType' => 'J'], ['ordering' => 'ASC'], 12);
        $categories = $repositories['category']->findBy([], ['createdAt' => 'DESC'], 12);
        $vendors = $repositories['vendor']->findBy([], ['createdAt' => 'DESC'], 12);

        $response = $this->render('homepage/homepage.html.twig', [
            'projects' => $projects,
            'products' => $products,
            'categories' => $categories,
            'featured' => $featured,
            'vendors' => $vendors,
        ]);

        $token = 'fgdfgFGDFGDFGdfdfdfgDFDFGDFG';

        // $userName = $this->getUser()->getUserIdentifier(); //TODO: getUserIdentifier()
        $userName = '$this->getUser()->getUserIdentifier()';
        $key = $this->getParameter('app_mercure_secret_key');

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
