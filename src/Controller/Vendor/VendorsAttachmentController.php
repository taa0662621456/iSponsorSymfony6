<?php

	namespace App\Controller\Vendor;


	use App\Entity\Vendor\Vendors;
	use App\Entity\Vendor\VendorsDocumentAttachments;
	use App\Entity\Vendor\VendorsMediaAttachments;
	use App\Form\Vendor\VendorsDocumentAttachmentsType;
	use App\Form\Vendor\VendorsMediaAttachmentsType;
	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class VendorsAttachmentController
		extends AbstractController
	{
		/**
		 * @var AttachmentsManager
		 */
		private $attachmentsManager;

		public function __construct(AttachmentsManager $attachmentsManager)
		{
			$this->attachmentsManager = $attachmentsManager;
		}

		/**
		 * @Route("/", name="vendor_get_attachments", methods={"GET"})
		 * @param Request     $request
		 * @param string|null $entity
		 * @param string|null $layout
		 *
		 * @return Response
		 */
		public function getAttachments(Request $request,
									   string $entity = 'App\Entity\Vendor\VendorsMediaAttachments',
									   string $layout = 'index'): Response
		{
			/**
			 * если роль Админ и выше, параметр $createdBy принимается из запроса,
			 * в противном случе = $this->getUser()
			 *
			 */

			if ($request->get('_route') == 'profile') {            //TODO: need add role by ROLE_ADMIN; maybe PHP Switch
				$createdBy = null;                                 // Vendor is null for template Security
				$published = true;                                 // ...for marketing security
				$fileLayoutPosition = $request->get('_route');     // ... for filtering
				$fileLang = $request->get('_locale') ?: '*';       // ... for different
			}

			$attachments = $this->attachmentsManager->getAttachments(
				$entity = null,
				$createdBy = '', //Important! Must by User object
				$published = true,
				$fileLayoutPosition = null,
				$fileClass = null,
				$fileLang = null
			);

			return $this->render(
				'vendor/vendors_attachments/' . $layout . '.html.twig',
				[
					'attachments' => $attachments,
				]
			);
		}

		/**
		 * @Route("/set", name="vendor_set_attachment", methods={"GET","POST"})
		 * @param Request $request
		 *
		 * @return Response
		 * @throws Exception
		 *
		 */
		public function setAttachment(Request $request): Response
		{
			$vendor = new Vendors();
			$form = $this->createForm(VendorsMediaAttachmentsType::class, $vendor);

			if ($request->request->get('_route') !== 'media')
				$form = $this->createForm(VendorsDocumentAttachmentsType::class, $vendor);

			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager = $this->getDoctrine()
									  ->getManager()
				;
				$entityManager->persist($vendor);
				$entityManager->flush();

				return $this->redirectToRoute('category_attachment_edit_slug');
			}

			return $this->render(
				'vendor/vendors/new.html.twig',
				[
					'vendors' => $vendor,
					'form'    => $form->createView(),
				]
			);
		}

		/**
		 * @Route("/{id<\d+>}", name="vendor_attachment_show_id", methods={"GET"})
		 * @Route("/{slug}", name="vendor_attachment_show_slug", methods={"GET"})
		 * @param VendorsMediaAttachments    $vendorsMediaAttachments
		 * @param VendorsDocumentAttachments $vendorsDocumentAttachments
		 *
		 * @return Response
		 *
		 * добавить ограничите по тем ИД, которые пренадлежать вендору (его собственные медиа, его собственные медия
		 * документов)
		 */
		public function show(VendorsMediaAttachments $vendorsMediaAttachments,
							 VendorsDocumentAttachments $vendorsDocumentAttachments): Response
		{
			//TODO: необходимо ветвление
			return $this->render(
				'vendor/vendors_attachments/show.html.twig',
				[
					'vendors_attachment' => $vendorsMediaAttachments,
				]
			);
		}

		/**
		 * @Route("/{slug}/edit", name="doc_edit", methods={"GET","POST"})
		 * @Route("/{id<\d+>}/edit", name="doc_edit", methods={"GET","POST"})
		 * @param Request                    $request
		 * @param VendorsMediaAttachments    $vendorsMediaAttachments
		 * @param VendorsDocumentAttachments $vendorsDocumentAttachments
		 *
		 * @return Response
		 */
		public function edit(Request $request,
							 VendorsMediaAttachments $vendorsMediaAttachments,
							 VendorsDocumentAttachments $vendorsDocumentAttachments): Response
		{

			$form = $this->createForm(VendorsMediaAttachmentsType::class, $vendorsMediaAttachments);

			if ($request->request->get('_route') !== 'media')
				$form = $this->createForm(VendorsDocumentAttachmentsType::class, $vendorsDocumentAttachments);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->getDoctrine()
					 ->getManager()
					 ->flush()
				;

				return $this->redirectToRoute('category_attachment_edit_slug');
			}

			return $this->render(        //TODO: необходимо ветвление между документами и простым медиа
				'vendor/vendors/edit.html.twig',
				[
					'vendors_attachment' => $vendorsMediaAttachments,
					'form'               => $form->createView(),
				]
			);
		}


		/**
		 * @Route("/{slug}", name="vendors_delete_slug", methods={"DELETE"})
		 * @Route("/{id<\d+>}", name="vendors_delete_id", methods={"DELETE"})
		 * @param Request                    $request
		 * @param VendorsMediaAttachments    $vendorsMediaAttachments
		 * @param VendorsDocumentAttachments $VendorsDocumentAttachmentsType
		 *
		 * @return Response
		 */
		public function delete(Request $request,
							   VendorsMediaAttachments $vendorsMediaAttachments,
							   VendorsDocumentAttachments $VendorsDocumentAttachmentsType): Response
		{
			//TODO: необходимо ветвление между документами и обычным медиа
			if ($this->isCsrfTokenValid(
				'delete' . $vendorsMediaAttachments->getId(), $request->request->get('_token')
			)) {
				$entityManager = $this->getDoctrine()
									  ->getManager()
				;
				$entityManager->remove($vendorsMediaAttachments);
				$entityManager->flush();
			}

			return $this->redirectToRoute('categories_attachments_get');
		}
	}