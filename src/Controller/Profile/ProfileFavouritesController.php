<?php
	declare(strict_types=1);

	namespace App\Controller\Profile;

	use App\Repository\ProductsFavouritesRepository;
	use App\Repository\ProjectsFavouritesRepository;
	use App\Repository\VendorsFavouritesRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	/**
	 * @Route("/profile/favourites")
	 */
	class ProfileFavouritesController extends AbstractController
	{
		/**
		 * @Route("/{favourites}", defaults={"page": "1", "_format"="html"}, name="favourites", methods={"GET"})
		 * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="homepage_paginated")
		 * @param                              $favourites
		 * @param ProjectsFavouritesRepository $projectsFavouritesRepository
		 * @param ProductsFavouritesRepository $productsFavouritesRepository
		 * @param VendorsFavouritesRepository  $vendorsFavouritesRepository
		 *
		 * @return Response
		 */
		public function favourites($favourites, ProjectsFavouritesRepository $projectsFavouritesRepository, ProductsFavouritesRepository $productsFavouritesRepository, VendorsFavouritesRepository $vendorsFavouritesRepository)
		{

			return $this->render('/' . $favourites . '.html.twig', array(
				// findBy() must have first parameter: 'createdBy' => $this->getUser()
				// for all next row
				'projects' => $projectsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
				'products' => $productsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
				'vendors' => $vendorsFavouritesRepository->findBy([], ['createdOn' => 'ASC'], 12, null)

			));
		}
	}