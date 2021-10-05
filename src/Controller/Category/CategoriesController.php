<?php
	declare(strict_types=1);

	namespace App\Controller\Category;

	use App\Entity\Category\Categories;
	use App\Entity\Category\CategoriesAttachments;
	use App\Entity\Category\CategoriesEnGb;
	use App\Form\Category\CategoriesType;
	use App\Repository\Category\CategoriesRepository;
	use App\Repository\FeaturedRepository;
	use App\Repository\Product\ProductsRepository;
	use App\Repository\Project\ProjectsRepository;
	use App\Service\AttachmentsManager;
	use Cocur\Slugify\Slugify;
	use Exception;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;


	/**
     * @Route("/categoriess")
     */
	class CategoriesController
		extends AbstractController
	{
		/**
		 * @var AttachmentsManager
		 */
		private $attachmentManager;

		public function __construct(AttachmentsManager $attachmentManager)
		{
			$this->attachmentManager = $attachmentManager;
		}

		/**
		 * @Route("/category/{id<\d+>}", methods={"GET"}, name="categories_category")
		 * @Route("/category/{categorySlug}", methods={"GET"}, name="category_slug")
		 * @param Categories           $id
		 * @param Categories           $slug
		 * @param CategoriesRepository $categoriesRepository
		 *
		 * @param ProjectsRepository   $projectsRepository
		 * @param ProductsRepository   $productsRepository
		 * @param FeaturedRepository   $featuredRepository
		 *
		 * @return Response
		 */
		public function category(Categories $id,
								 Categories $slug,
								 CategoriesRepository $categoriesRepository,
								 ProjectsRepository $projectsRepository,
								 ProductsRepository $productsRepository,
								 FeaturedRepository $featuredRepository): Response
		{

			return $this->render(
				'category/categories/categories_category.html.twig',
				array(
					'category' => $categoriesRepository->findOneBy(array('parent' => $id), array('id' => 'ASC')),
					/*
					'latest_projects' => $projectsRepository->findBy([], ['createdAt' => 'ASC'], 12, null),
					'latest_products' => $productsRepository->findBy([], ['createdAt' => 'ASC'], 12, null),
					'featured_projects' => $featuredRepository->findBy(['featuredType' => 'J'], ['ordering' => 'ASC'], 12, null),
					'featured_products' => $featuredRepository->findBy(['featuredType' => 'D'], ['ordering' => 'ASC'], 12, null),
					'featured_categories' => $featuredRepository->findBy(['featuredType' => 'C'], ['ordering' => 'ASC'], 12, null),
					'featured_vendors' => $featuredRepository->findBy(['featuredType' => 'V'], ['ordering' => 'ASC'], 12, null)
					'categories' => $categoriesRepository->findBy(['published' => true, 'children' =>], ['id' => 'ASC']),
					'categories' => $categoriesRepository->findOneBy(['published' => true], ['id' => 'ASC']),
					*/
				)
			);

		}

		/**
		 * @Route("/new", name="categories_new", methods={"GET","POST"})
		 * @param Request $request
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function new(Request $request): Response
		{

			$slug = new Slugify();
			$category = new Categories();
			$categoryEnGb = new CategoriesEnGb();
			$categoryAttachment = new CategoriesAttachments();
			$categoryAttachment->setFileClass('');
			$category->getCategoryAttachments()->add($categoryAttachment);


			//$this->denyAccessUnlessGranted('edit', $category);

			$form = $this->createForm(CategoriesType::class, $category);
			$form->handleRequest($request);

			//dump($form->getData());

			if ($form->isSubmitted() && $form->isValid()) {

				$entityManager = $this->getDoctrine()
									  ->getManager()
				;
				$entityManager->persist($category);

				$s = $form->get('CategoryEnGb')->get('slug')->getData();

				if (!isset($s)) {
					$category->setSlug($slug->slugify($categoryEnGb->getCategoryName()));
				}
				$entityManager->flush();

				return $this->redirectToRoute('categories');
			}

			return $this->render(
				'category/categories/new.html.twig', [
					'category' => $category,
					'form'     => $form->createView(),
				]
			);
		}

	}
