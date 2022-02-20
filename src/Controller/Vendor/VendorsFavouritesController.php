<?php


	namespace App\Controller\Vendor;

	use App\Repository\Category\CategoryFavouriteRepository;
	use App\Repository\Product\ProductFavouriteRepository;
	use App\Repository\Project\ProjectFavouriteRepository;
	use App\Repository\Vendor\VendorFavouriteRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	#[Route(path: '/profile/favourites')]
	class VendorsFavouritesController extends AbstractController
	{
        /**
         * @param                                    $favourites
         * @param ProjectFavouriteRepository $projectsFavouritesRepository
         * @param ProductFavouriteRepository $productsFavouritesRepository
         * @param VendorFavouriteRepository $vendorsFavouritesRepository
         * @param CategoryFavouriteRepository $categoriesFavouritesRepository
         * @return Response
         */
		#[Route(path: '/{favourites}', name: 'favourites', defaults: ['page' => 1, '_format' => 'html'], methods: ['GET'])]
		#[Route(path: '/{favourites}', name: 'favourites_XmlHttpReq', defaults: ['page' => 1, '_format' => 'xmlhttp'], methods: ['GET'])]
		#[Route(path: '/page/{page<[1-9]\d*>}', name: 'home_paginated', defaults: ['_format' => 'html'], methods: ['GET'])]
		public function favourites($favourites, ProjectFavouriteRepository $projectsFavouritesRepository, ProductFavouriteRepository $productsFavouritesRepository, VendorFavouriteRepository $vendorsFavouritesRepository, CategoryFavouriteRepository $categoriesFavouritesRepository): Response
        {
			return $this->render(
				'/' . $favourites . '.html.twig', array(
					// findBy() must have first parameter: 'createdBy' => $this->getUser()
					// for all next row
					'categories' => $categoriesFavouritesRepository->findBy(
						['published' => 't'], ['createdAt' => 'ASC'], 12, null
					),
					'projects'   => $projectsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12, null),
					'products'   => $productsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12, null),
					'vendors'    => $vendorsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12, null)
				)
			);
		}
	}
