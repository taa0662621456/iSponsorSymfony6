<?php

	namespace App\Controller;

	use App\Entity\Menu\MenusItems;
	use App\Form\Menu\MenusItemsType;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	/**
	 * @Route("/menus/items")
	 */
	class MenusItemsController
		extends AbstractController
	{
		/**
		 * @Route("/", name="menus_items_index", methods={"GET"})
		 */
		public function index(): Response
		{
			$menusItems = $this->getDoctrine()
							   ->getRepository(MenusItems::class)
							   ->findAll()
			;

			return $this->render(
				'menu/menus_items/index.html.twig', [
				'menus_items' => $menusItems,
			]
			);
		}

		/**
		 * @Route("/new", name="menus_items_new", methods={"GET","POST"})
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function new(Request $request): Response
		{
			$menusItem = new MenusItems();
			$form = $this->createForm(MenusItemsType::class, $menusItem);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($menusItem);
				$entityManager->flush();

				return $this->redirectToRoute('menus_items_index');
			}

			return $this->render(
				'menu/menus_items/new.html.twig', [
				'menus_item' => $menusItem,
				'form'       => $form->createView(),
			]
			);
		}

		/**
		 * @Route("/{id}", name="menus_items_show", methods={"GET"})
		 * @param MenusItems $menusItem
		 *
		 * @return Response
		 */
		public function show(MenusItems $menusItem): Response
		{
			return $this->render(
				'menu/menus_items/show.html.twig', [
				'menus_item' => $menusItem,
			]
			);
		}

		/**
		 * @Route("/{id}/edit", name="menus_items_edit", methods={"GET","POST"})
		 * @param Request    $request
		 * @param MenusItems $menusItem
		 *
		 * @return Response
		 */
		public function edit(Request $request, MenusItems $menusItem): Response
		{
			$form = $this->createForm(MenusItemsType::class, $menusItem);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->getDoctrine()->getManager()->flush();

				return $this->redirectToRoute('menus_items_index');
			}

			return $this->render(
				'menu/menus_items/edit.html.twig', [
				'menus_item' => $menusItem,
				'form'       => $form->createView(),
			]
			);
		}

		/**
		 * @Route("/{id}", name="menus_items_delete", methods={"DELETE"})
		 * @param Request    $request
		 * @param MenusItems $menusItem
		 *
		 * @return Response
		 */
		public function delete(Request $request, MenusItems $menusItem): Response
		{
			if ($this->isCsrfTokenValid('delete' . $menusItem->getId(), $request->request->get('_token'))) {
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->remove($menusItem);
				$entityManager->flush();
			}

			return $this->redirectToRoute('menus_items_index');
		}
	}
