<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category\CategoriesAttachments;
use App\Entity\Category\CategoriesEnGb;
use App\Entity\Category\Categories;
use App\Form\Category\CategoriesType;
use App\Repository\CategoriesRepository;
use App\Service\AttachmentManager;
use Cocur\Slugify\Slugify;
use Exception;
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
     * @var AttachmentManager
     */
    private $attachmentManager;

    public function __construct(AttachmentManager $attachmentManager)
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
	 * @Route("/category/{id<\d+>}", methods={"GET"}, name="categories_category")
	 * @param Categories           $category
	 * @param CategoriesRepository $categoriesRepository
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
                $category->setCategorySlug($slug->slugify($categoryEnGb->getCategoryName()));
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
     * @Route("/{id<\d+>}", name="categories_show", methods={"GET"})
     * @param Categories $category
     * @return Response
     */
    public function show(Categories $category): Response
    {
        return $this->render('category/categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    /*
    /**
     * @Route("/{slug}", methods={"GET"}, name="show_by_slug")
     * @param CategoriesEnGb $slug
     * @return Response
     *
    public function slug(CategoriesEnGb $slug): Response
    {
        return $this->render('category/details.html.twig', [
            'category' => $slug
        ]);
    }

    */

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
