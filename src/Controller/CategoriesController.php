<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category\CategoriesAttachments;
use App\Entity\Category\CategoriesEnGb;
use App\Entity\Category\Categories;
use App\Form\Category\CategoriesType;
use App\Repository\CategoriesRepository;
use App\Repository\FeaturedRepository;
use App\Repository\Product\ProductsRepository;
use App\Repository\Project\ProjectsRepository;
use App\Service\AttachmentsManager;
use Cocur\Slugify\Slugify;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/categories")
 */
class CategoriesController extends AbstractController
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
	 * @Route("/", name="categories_index", methods={"GET"})
	 * @param CategoriesRepository $categories
	 *
	 * @return Response
	 */
	public function categories(CategoriesRepository $categories): Response
	{
		return $this->render('category/categories/index.html.twig', array(
            'categories' => $categories->findAll(),
		));
    }

	/**
	 * For back-end; for administrator
	 *
	 * @Route("/category/{id<\d+>}", methods={"GET"}, name="categories_category")
	 * @param Categories           $category
	 * @param CategoriesRepository $categoriesRepository
	 *
	 * @return Response
	 */
	public function category(Categories $category, CategoriesRepository $categoriesRepository): Response
	{

		return $this->render('category/categories/categories_category.html.twig', array(
			'category' => $categoriesRepository->findOneBy(array('parent' => $category), array('id' => 'ASC'))
		));

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
		$form = $this->createForm(CategoriesType::class, $category);
		$form->handleRequest($request);

		//dump($form->getData());

        if ($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();

            $s = $form->getData()->categoryEnGb->getSlug();

            if (!isset($s)) {
				$category->setSlug($slug->slugify($categoryEnGb->getCategoryName()));
            }

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->render('category/categories/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

	/**
	 * For back-end; for administrators only
	 *
	 * @Route("/category/{id<\d+>}", name="categories_show", methods={"GET"})
	 * @param Categories $category
	 *
     * @return Response
     */
    public function show(Categories $category): Response
    {
        return $this->render('category/categories/show.html.twig', [
            'category' => $category,
		]);
	}


	/**
	 * @Route("/{categorySlug}", methods={"GET"}, name="category_slug")
	 * @param Categories           $category_slug
	 * @param CategoriesRepository $categoriesRepository
	 *
	 * @param ProjectsRepository   $projectsRepository
	 * @param ProductsRepository   $productsRepository
	 * @param FeaturedRepository   $featuredRepository
	 *
	 * @return Response
	 */
	public function slug(Categories $category_slug, CategoriesRepository $categoriesRepository, ProjectsRepository $projectsRepository, ProductsRepository $productsRepository, FeaturedRepository $featuredRepository): Response
	{

		//$id = $category_slug->getId();
		return $this->render('category/categories_category/index.html.twig', array(
			'category' => $category_slug,
			'projects' => $projectsRepository->findBy(['projectCategory' => $category_slug->getId(), 'published' => 1], ['createdOn' => 'ASC'], 1000, null),
			/*
			'latest_projects' => $projectsRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
			'latest_products' => $productsRepository->findBy([], ['createdOn' => 'ASC'], 12, null),
			'featured_projects' => $featuredRepository->findBy(['featuredType' => 'J'], ['ordering' => 'ASC'], 12, null),
			'featured_products' => $featuredRepository->findBy(['featuredType' => 'D'], ['ordering' => 'ASC'], 12, null),
			'featured_categories' => $featuredRepository->findBy(['featuredType' => 'C'], ['ordering' => 'ASC'], 12, null),
			'featured_vendors' => $featuredRepository->findBy(['featuredType' => 'V'], ['ordering' => 'ASC'], 12, null)
			'categories' => $categoriesRepository->findBy(['published' => true, 'children' =>], ['id' => 'ASC']),
			'categories' => $categoriesRepository->findOneBy(['published' => true], ['id' => 'ASC']),
			*/
		));
	}

    /**
     * @Route("/{id<\d+>}/edit", name="categories_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Categories $category
     * @return Response
     */
    public function edit(Request $request, Categories $category): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->render('category/categories/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/attachment/{id}", name="attachment")
     * @param Request $request
     * @param Categories $projects
     * @param CategoriesAttachments $projectsAttachments
     * @return Response
     */
    public function attachment(Request $request, Categories $projects, CategoriesAttachments $projectsAttachments)
    {
        $file = $request->get('file');

        $filenameAndPath = $this->attachmentManager->uploadAttachment($file, $projects, $projectsAttachments);

        return $this->json([
            'location' => $filenameAndPath['path']
        ]);
    }

    /**
     * @Route("/{id}", name="categories_delete", methods={"DELETE"})
     * @param Request $request
     * @param Categories $category
     * @return Response
     */
    public function delete(Request $request, Categories $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_index');
    }
    
}
