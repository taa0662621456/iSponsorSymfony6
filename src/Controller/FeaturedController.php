<?php

namespace App\Controller;

use App\Entity\Featured\Featured;
use App\Form\Featured\FeaturedType;
use App\Repository\Featured\FeaturedRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/featured')]
class FeaturedController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }
    /**
     * @param FeaturedRepository $featuredRepository
     * @return Response
     */
	#[Route(path: '/', name: 'featured_index', methods: ['GET'])]
	public function index(FeaturedRepository $featuredRepository) : Response
	{
		return $this->render('featured/index.html.twig', [
      'features' => $featuredRepository->findAll(),
  ]);
	}

    /**
     * @param FeaturedRepository $featuredRepository
     * @return Response
     */
	#[Route(path: '/projects', name: 'featured_projects', methods: ['GET'])]
	public function projects(FeaturedRepository $featuredRepository) : Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'J'], ['id' => 'ASC']),
		]);
	}

    /**
     * @param FeaturedRepository $featuredRepository
     * @return Response
     */
	#[Route(path: '/products', name: 'featured_products', methods: ['GET'])]
	public function products(FeaturedRepository $featuredRepository) : Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'D'], ['id' => 'ASC']),
		]);
	}

    /**
     * @param FeaturedRepository $featuredRepository
     * @return Response
     */
	#[Route(path: '/categories', name: 'featured_categories', methods: ['GET'])]
	public function categories(FeaturedRepository $featuredRepository) : Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'C'], ['id' => 'ASC']),
		]);
	}

    /**
     * @param FeaturedRepository $featuredRepository
     * @return Response
     */
	#[Route(path: '/vendors', name: 'featured_vendors', methods: ['GET'])]
	public function vendors(FeaturedRepository $featuredRepository) : Response
	{
		return $this->render('featured/index.html.twig', [
			'features' => $featuredRepository->findOneBy(['featuredType' => 'V'], ['id' => 'ASC']),
		]);
	}
	#[Route(path: '/new', name: 'featured_new', methods: ['GET', 'POST'])]
	public function new(Request $request) : Response
	{
		$featured = new Featured();
		$form = $this->createForm(FeaturedType::class, $featured);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->managerRegistry->getManager();
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
     * @param Featured $featured
     * @return Response
     */
	#[Route(path: '/{id}', name: 'featured_show', methods: ['GET'])]
	public function show(Featured $featured) : Response
	{
		return $this->render('featured/show.html.twig', [
      'featured' => $featured,
  ]);
	}

    /**
     * @param Request $request
     * @param Featured $featured
     * @return Response
     */
	#[Route(path: '/{id}/edit', name: 'featured_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, Featured $featured) : Response
	{
		$form = $this->createForm(FeaturedType::class, $featured);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
      $this->managerRegistry->getManager()->flush();

      return $this->redirectToRoute('featured_index');
  }
		return $this->render('featured/edit.html.twig', [
      'featured' => $featured,
      'form' => $form->createView(),
  ]);
	}

    /**
     * @param Request $request
     * @param Featured $featured
     * @return Response
     */
	#[Route(path: '/{id}', name: 'featured_delete', methods: ['DELETE'])]
	public function delete(Request $request, Featured $featured) : Response
	{
		if ($this->isCsrfTokenValid('delete'.$featured->getId(), $request->request->get('_token'))) {
      $entityManager = $this->managerRegistry->getManager();
      $entityManager->remove($featured);
      $entityManager->flush();
  }
		return $this->redirectToRoute('featured_index');
	}
}