<?php

	namespace App\Controller\Vendor;


	use App\Entity\Vendor\Vendors;
	use App\Entity\Vendor\VendorsDocAttachments;
	use App\Form\Vendor\VendorsDocAttachmentsType;
	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class VendorsAttachmentController extends AbstractController
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
		 * @Route("/", name="docs", methods={"GET"})
		 * @param string|null $entity
		 * @param string|null $layout
		 *
		 * @return Response
		 */
		public function index(string $entity = 'App\Entity\Vendor\VendorsMediaAttachments', string $layout = 'index'): Response
		{
			$attachments = $this->attachmentsManager->getAttachments(
				$entity,
				$createdBy = $this->getUser(),
				$published = true,
				$fileLayoutPosition = 'homepage',
				(string)$fileClass = null,
				(string)$fileLang = null
			);

			return $this->render('vendor/vendors_attachments/' . $layout . '.html.twig', [
				'attachments' => $attachments,
			]);
		}

		/**
		 * @Route("/new", name="doc_new", methods={"GET","POST"})
		 * @param Request $request
		 *
		 * @return Response
		 * @throws Exception
		 *
		 * необходимо засетить тип медиа (документ, возможно добавить(засетить класс) любую информацию, что будет
		 * отличать данный тип медиа от простых изображений и др. типов)
		 */
		public function new(Request $request): Response
		{
			$vendor = new Vendors();
			$form = $this->createForm(VendorsDocAttachmentsType::class, $vendor);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {

				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($vendor);
				$entityManager->flush();

				return $this->redirectToRoute('docs');
			}

			return $this->render('vendor/vendors/new.html.twig', [
				'vendors' => $vendor,
				'form' => $form->createView(),
			]);
		}

		/**
		 * @Route("/{id<\d+>}", name="doc_show", methods={"GET"})
		 * @param VendorsDocAttachments $vendorsAttachments
		 *
		 * @return Response
		 *
		 * добавить ограничите по тем ИД, которые пренадлежать вендору (его собственные медиа, его собственные медия
		 * документов)
		 */
		public function show(VendorsDocAttachments $vendorsAttachments): Response
		{
			return $this->render('vendor/vendors_attachments/show.html.twig', [
				'vendors_attachment' => $vendorsAttachments,
			]);
		}

		/**
		 * @Route("/{id<\d+>}/edit", name="doc_edit", methods={"GET","POST"})
		 * @param Request               $request
		 * @param VendorsDocAttachments $vendorsAttachments
		 *
		 * @return Response
		 */
		public function edit(Request $request, VendorsDocAttachments $vendorsAttachments): Response
		{
			$form = $this->createForm(VendorsDocAttachmentsType::class, $vendorsAttachments);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid()) {
				$this->getDoctrine()->getManager()->flush();

				return $this->redirectToRoute('doc_show');
			}

			return $this->render('vendor/vendors/edit.html.twig', [
				'vendors_attachment' => $vendorsAttachments,
				'form' => $form->createView(),
			]);
		}


		/**
		 * @Route("/{id}", name="vendors_delete", methods={"DELETE"})
		 * @param Request               $request
		 * @param VendorsDocAttachments $vendorsAttachments
		 *
		 * @return Response
		 *
		 * добавить ограничение удаления только своих медиа с "типом", документ или паспорт
		 * добавить ограничение по принципу "пометить на удаление"
		 */
		public function delete(Request $request, VendorsDocAttachments $vendorsAttachments): Response
		{
			if ($this->isCsrfTokenValid('delete' . $vendorsAttachments->getId(), $request->request->get('_token'))) {
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->remove($vendorsAttachments);
				$entityManager->flush();
			}

			return $this->redirectToRoute('docs');
		}
	}