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
		 *
		 * @return Response
		 */
		public function getBrickImages()
		{
			$files = $this->attachmentsManager->getAttachments(
				$entity = 'App\Entity\Category\CategoriesAttachments',
				$createdBy = null,
				$published = true,
				$fileLayoutPosition = 'homepage',
				$fileClass = '',
				$fileLang = ''
			);
			return $this->render('attachment/attachments.html.twig', array(
				'files' => $files
			));
		}
	}