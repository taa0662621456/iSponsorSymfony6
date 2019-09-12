<?php

namespace App\Controller;

use App\Entity\Featured;
use App\Form\FeaturedType;
use App\Repository\FeaturedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/featured")
 */
class FeaturedController extends AbstractController
{
	/**
	 * @Route("/", name="featured_index", methods={"GET"})
	 * @param FeaturedRepository $featuredRepository
	 *
	 * @return Response
	 */
    public function index(FeaturedRepository $featuredRepository): Response
    {
        return $this->render('featured/index.html.twig', [
            'features' => $featuredRepository->findAll(),
        ]);
    }

	/**
	 * @Route("/projects", name="featured_projects", methods={"GET"})
	 * @param FeaturedRepository $featuredRepository
	 *
	 * @return Response
	 */
	public function projects(FeaturedRepository $featuredRepository): Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'J'], ['id' => 'ASC']),
		]);
	}

	/**
	 * @Route("/products", name="featured_products", methods={"GET"})
	 * @param FeaturedRepository $featuredRepository
	 *
	 * @return Response
	 */
	public function products(FeaturedRepository $featuredRepository): Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'D'], ['id' => 'ASC']),
		]);
	}

	/**
	 * @Route("/categories", name="featured_categories", methods={"GET"})
	 * @param FeaturedRepository $featuredRepository
	 *
	 * @return Response
	 */
	public function categories(FeaturedRepository $featuredRepository): Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'C'], ['id' => 'ASC']),
		]);
	}

	/**
	 * @Route("/vendors", name="featured_vendors", methods={"GET"})
	 * @param FeaturedRepository $featuredRepository
	 *
	 * @return Response
	 */
	public function vendors(FeaturedRepository $featuredRepository): Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'V'], ['id' => 'ASC']),
		]);
	}

	/**
	 * @Route("/new", name="featured_new", methods={"GET","POST"})
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $featured = new Featured();
        $form = $this->createForm(FeaturedType::class, $featured);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($featured);
            $entityManager->flush();

            return $this->redirectToRoute('featured_index');
        }

        return $this->render('featured/new.html.twig', [
            'featured' => $featured,
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/{id}", name="featured_show", methods={"GET"})
	 * @param Featured $featured
	 *
	 * @return Response
	 */
    public function show(Featured $featured): Response
    {
        return $this->render('featured/show.html.twig', [
            'featured' => $featured,
        ]);
    }

	/**
	 * @Route("/{id}/edit", name="featured_edit", methods={"GET","POST"})
	 * @param Request  $request
	 * @param Featured $featured
	 *
	 * @return Response
	 */
    public function edit(Request $request, Featured $featured): Response
    {
        $form = $this->createForm(FeaturedType::class, $featured);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('featured_index');
        }

        return $this->render('featured/edit.html.twig', [
            'featured' => $featured,
            'form' => $form->createView(),
        ]);
    }

	/**
	 * @Route("/{id}", name="featured_delete", methods={"DELETE"})
	 * @param Request  $request
	 * @param Featured $featured
	 *
	 * @return Response
	 */
    public function delete(Request $request, Featured $featured): Response
    {
        if ($this->isCsrfTokenValid('delete'.$featured->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($featured);
            $entityManager->flush();
        }

        return $this->redirectToRoute('featured_index');
    }
}
