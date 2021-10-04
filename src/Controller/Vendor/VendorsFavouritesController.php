<?php
	declare(strict_types=1);

	namespace App\Controller\Vendor;

	use App\Repository\Category\CategoriesFavouritesRepository;
	use App\Repository\Product\ProductsFavouritesRepository;
	use App\Repository\Project\ProjectsFavouritesRepository;
	use App\Repository\Vendor\VendorsFavouritesRepository;
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
		 * @param ProjectsFavouritesRepository       $projectsFavouritesRepository
		 * @param ProductsFavouritesRepository       $productsFavouritesRepository
		 * @param VendorsFavouritesRepository        $vendorsFavouritesRepository
		 * @param CategoriesFavouritesRepository     $categoriesFavouritesRepository
		 *
		 * @return Response
		 */
		public function favourites($favourites, ProjectsFavouritesRepository $projectsFavouritesRepository,
								   ProductsFavouritesRepository $productsFavouritesRepository,
								   VendorsFavouritesRepository $vendorsFavouritesRepository,
								   CategoriesFavouritesRepository $categoriesFavouritesRepository)
		{

			return $this->render(
				'/' . $favourites . '.html.twig', array(
					// findBy() must have first parameter: 'createdBy' => $this->getUser()
					// for all next row
					'categories' => $categoriesFavouritesRepository->findBy(
						['published' => 't'], ['createdOn' => 'ASC'], 12, null
					),
					'projects'   => $projectsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
					'products'   => $productsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
					'vendors'    => $vendorsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null)
				)
			);
		}
	}