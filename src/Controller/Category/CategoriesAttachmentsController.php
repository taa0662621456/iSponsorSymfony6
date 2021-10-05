<?php
	declare(strict_types=1);

	namespace App\Controller\Category;

	use App\Entity\Category\CategoriesAttachments;
	use App\Form\Category\CategoriesAttachmentsType;
	use App\Service\AttachmentsManager;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

	/**
	 * Class CategoriesAttachmentsController
	 *
	 * @package App\Controller\Category
	 * @Route("categories/attachments")
	 */
	class CategoriesAttachmentsController
		extends AbstractController
	{
		/**
		 * @var AttachmentsManager
		 */
		private $attachmentsManager;
		/**
		 * @var EntityManagerInterface
		 */
		private $entity;
        /**
         * @var RequestStack
         */
        private $requestStack;

        public function __construct(AttachmentsManager $attachmentsManager,
									EntityManagerInterface $entity,
                                    RequestStack $requestStack)
		{
			$this->attachmentsManager = $attachmentsManager;
			$this->entity = $entity;
            $this->requestStack = $requestStack;
		}

        /**
         * @Route("/", name="categories_attachments_get", methods={"GET"})
         * @param AuthorizationCheckerInterface $authChecker
         * @param null $name
         * @param int|null $id
         * @param string|null $slug
         * @param int|null $createdBy
         * @param bool|true $published
         * @param string|null $fileLang
         *
         * @return Response
         */
		public function getAttachments(AuthorizationCheckerInterface $authChecker,
									   $name = null,
									   int $id = null,
									   string $slug = null,
									   int $createdBy = null,
									   bool $published = true,
									   string $fileLang = null): Response
		{
			$route = $this->requestStack->getMainRequest()->attributes->get('_route');

			if (false === $authChecker->isGranted('ROLE_ADMIN')){
                $id = null;
                $slug = null;
                $createdBy = null;
                $published = true;
                $fileLayoutPosition = $route;
                $fileClass = null;
                $fileLang = $route;
            }
				$attachments = $this->attachmentsManager->getAttachments(
					$entity = 'App\Entity\Category\CategoriesAttachments',
					$id = null,
					$slug = null,
					$createdBy = null,
					$published = true,
					$fileLayoutPosition = $route,
					$fileClass = null,
					$fileLang = $route
				);

			return $this->render(
				'category/categories_attachments/' . $route . '_attachments.html.twig',
				array(
					'attachments' => $attachments,
				)
			);
		}

		/**
		 * @Route("/set", name="categories_attachment_set", methods={"GET","POST"})
		 * @Route("/add", name="categories_attachment_add", methods={"GET","POST"})
		 * @Route("/new", name="categories_attachment_new", methods={"GET","POST"})
		 * @param Request $request
		 *
		 * @return Response
		 */
		public function setAttachment(Request $request): Response
		{
			$attachment = new CategoriesAttachments();

			//$this->denyAccessUnlessGranted('create', $attachment);

			$form = $this->createForm(
				CategoriesAttachmentsType::class,
				$attachment
			);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager = $this->getDoctrine()
									  ->getManager()
				;
				$entityManager->persist($attachment);
				$entityManager->flush();

				return $this->redirectToRoute('categories_attachments_get');
			}

			return $this->render(
				'vendor/vendors/new.html.twig',
				[
					'attachment' => $attachment,
					'form'       => $form->createView(),
				]
			);
		}

		/**
		 * @Route("/{id<\d+>}/show", name="categories_attachments_id", methods={"GET"})
		 * @Route("/{slug}/show", name="categories_attachments_slug", methods={"GET"})
		 * @param CategoriesAttachments $categoriesAttachments
		 *
		 * @return Response
		 *
		 */
		public function showAttachment(CategoriesAttachments $categoriesAttachments): Response
		{
			$this->denyAccessUnlessGranted('show', $categoriesAttachments);
			return $this->render(
				'vendor/vendors_attachments/show.html.twig',
				[
					'attachment' => $categoriesAttachments,
				]
			);
		}

		/**
		 * @Route("/{id<\d+>}/edit", name="category_attachment_edit_id", methods={"GET","POST"})
		 * @Route("/{slug}/edit", name="category_attachment_edit_slug", methods={"GET","POST"})
		 * @param Request               $request
		 *
		 * @param CategoriesAttachments $categoriesAttachments
		 *
		 * @param int                   $id
		 * @param string                $slug
		 *
		 * @return Response
		 * Security("categoriesAttachments.isAuthor(vendor)")
		 * Security("has_role('ROLE_ADMIN')
		 */
		public function editAttachment(Request $request, CategoriesAttachments $categoriesAttachments, int $id,
									   string $slug): Response
		{
			$this->denyAccessUnlessGranted('edit', $categoriesAttachments);

			$form = $this->createForm(
				CategoriesAttachmentsType::class,
				$categoriesAttachments
			);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->getDoctrine()
					 ->getManager()
					 ->flush()
				;

				return $this->redirectToRoute('');
			}

			return $this->render(
				'vendor/vendors/edit.html.twig',
				[
					'vendors_attachment' => $categoriesAttachments,
					'form'               => $form->createView(),
				]
			);
		}


		/**
		 * @Route("/{id<\d+>/delete}", name="category_attachment_delete_id", methods={"DELETE"})
		 * @Route("/{slug}/delete", name="category_attachment_delete_slug", methods={"DELETE"})
		 * @param Request               $request
		 *
		 * @param CategoriesAttachments $categoriesAttachments
		 *
		 * @param int                   $id
		 * @param string                $slug
		 *
		 * @return Response
		 * Security("categoriesAttachments.isAuthor(vendor)")
		 * Security("has_role('ROLE_ADMIN')
		 */
		public function deleteAttachment(Request $request, CategoriesAttachments $categoriesAttachments, int $id,
										 string $slug): Response
		{
			$this->denyAccessUnlessGranted('delete', $categoriesAttachments);

			if ($this->isCsrfTokenValid(
				'delete' . $categoriesAttachments->getId(),
				$request->request->get('_token')
			)) {
				$entityManager = $this->getDoctrine()
									  ->getManager()
				;
				$entityManager->remove($categoriesAttachments);
				$entityManager->flush();
			}

			return $this->redirectToRoute('categories_attachments_get');
		}
	}