<?php

	namespace App\Controller\Category;

	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;

	class CategoryAttachmentsController extends AbstractController
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
		 * @param string|null $layout
		 *
		 * @return Response
		 */
		public function getBrickImages(string $layout = 'attachment')
		{
			$attachments = $this->attachmentsManager->getAttachments(
				$entity = 'App\Entity\Category\CategoriesAttachments',
				$createdBy = null,
				$published = true,
				$fileLayoutPosition = 'homepage',
				$fileClass = '',
				$fileLang = ''
			);
			return $this->render('attachment/' . $layout . '.html.twig', array(
				'attachments' => $attachments
			));
		}
	}