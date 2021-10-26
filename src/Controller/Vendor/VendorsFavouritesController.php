<?php
	declare(strict_types=1);

	namespace App\Controller\Vendor;

	use App\Repository\Category\CategoryFavouriteRepository;
	use App\Repository\Product\ProductFavouriteRepository;
	use App\Repository\Project\ProjectFavouriteRepository;
	use App\Repository\Vendor\VendorFavouriteRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	/**
	 * @Route("/profile/favourites")
	 */
	class VendorsFavouritesController extends AbstractController
	{
		/**
		 * @Route("/{favourites}", defaults={"page": "1", "_format"="html"}, name="favourites", methods={"GET"})
		 * @Route("/{favourites}", defaults={"page": "1", "_format"="xmlhttp"}, name="favourites_XmlHttpReq",
		 *                         methods={"GET"})
		 * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="home_paginated")
		 * @param                                    $favourites
		 * @param ProjectFavouriteRepository       $projectsFavouritesRepository
		 * @param ProductFavouriteRepository       $productsFavouritesRepository
		 * @param VendorFavouriteRepository        $vendorsFavouritesRepository
		 * @param CategoryFavouriteRepository     $categoriesFavouritesRepository
		 *
		 * @return Response
		 */
		public function favourites($favourites, ProjectFavouriteRepository $projectsFavouritesRepository,
                                   ProductFavouriteRepository $productsFavouritesRepository,
                                   VendorFavouriteRepository $vendorsFavouritesRepository,
                                   CategoryFavouriteRepository $categoriesFavouritesRepository)
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
