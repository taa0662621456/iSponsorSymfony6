<?php
	declare(strict_types=1);

	namespace App\Controller;

	use App\Repository\Category\CategoryRepository;
    use App\Repository\Featured\FeaturedRepository;
    use App\Repository\Product\ProductRepository;
    use App\Repository\Project\ProjectRepository;
    use Exception;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Cookie;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class HomepageController extends AbstractController
    {


        /**
         * @Route("/", defaults={"page": "1", "_format"="html", "_locale": "en", "_local_filter": "en-gb"}, methods={"GET"}, name="homepage",
         *     requirements={"_locale": "^[a-z]{2}$", "_local_filter": "^[a-z]{2}$"})
         *
         * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="homepage_paginated",
         *     requirements={"_locale": "^[a-z]{2}$", "_local_filter": "^[a-z]{2}$"})
         *
         *
         * @param CategoryRepository $categoriesRepository
         * @param ProjectRepository $projectsRepository
         * @param ProductRepository $productsRepository
         * @param FeaturedRepository $featuredRepository
         *
         * @return Response
         * @throws Exception
         */
        public function index(CategoryRepository $categoriesRepository, ProjectRepository $projectsRepository,
                              ProductRepository $productsRepository, FeaturedRepository $featuredRepository): Response
        {
            $token = 'fgdfgFGDFGDFGdfdfdfgDFDFGDFG';
            //$userName = $this->getUser()->getUserIdentifier(); //TODO: getUserIdentifier()
            $userName = '$this->getUser()->getUserIdentifier()';
            $key = $this->getParameter('mercure_secret_key');



            $response = $this->render(
                'homepage/homepage.html.twig', array(
                    'categories' => $categoriesRepository->findAll(),
                    //'categories' => $categoriesRepository->findOneBy(
                    //  ['published' => 't'], ['id' => 'ASC']),
                    'latest_projects' => $projectsRepository->findBy(
                        [], ['createdAt' => 'ASC'], 12, null),
                    'latest_products' => $productsRepository->findBy(
                        [], ['createdAt' => 'ASC'], 12, null),
                    'featured_projects' => $featuredRepository->findBy(
                        ['featuredType' => 'J'], ['ordering' => 'ASC'], 12, null
                    ),
                    'featured_products' => $featuredRepository->findBy(
                        ['featuredType' => 'D'], ['ordering' => 'ASC'], 12, null
                    ),
                    'featured_categories' => $featuredRepository->findBy(
                        ['featuredType' => 'C'], ['ordering' => 'ASC'], 12, null
                    ),
                    'featured_vendors' => $featuredRepository->findBy(
                        ['featuredType' => 'V'], ['ordering' => 'ASC'], 12, null
                    )
                )
            );

            $response->headers->setCookie(
                new Cookie(
                    'mercureAuthorisation',
                    $token,
                    (new \DateTime())
                        ->add(new \DateInterval('PT2H')),
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

