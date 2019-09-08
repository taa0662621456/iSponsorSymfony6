<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\CategoriesCategory;
use App\Repository\CategoriesRepository;
use App\Repository\ProjectsRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/categories")
 *
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="categories")
     */
    public function categories(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository(CategoriesRepository::class)->findAll();

        return $this->render('categories/categories.html.twig', [
            'categories' => $categories
        ]);

    }

    /**
     * @Route("/category/{categoryParentId}", methods={"GET"}, name="categories_category")
     * @param CategoriesCategory $categoryParentId
     * @return Response
     */
    public function category(CategoriesCategory $categoryParentId): Response
    {

        $em = $this->getDoctrine()->getManager();

        $categories = $em
            ->getRepository(CategoriesCategory::class)
            ->findOneBy(['categories_category.category_parent_id' => $categoryParentId]);

        return $this->render('categories/category.html.twig', [
            'category' => $categories
        ]);

    }
}