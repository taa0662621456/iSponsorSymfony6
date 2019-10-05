<?php
	declare(strict_types=1);

	namespace App\Controller;

	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;

	class SystemMediaHandlerController extends AbstractController
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
		 * @param string      $entity
		 * @param string      $fileLang
		 * @param string|null $layout
		 *
		 * @return Response
		 */
		public function getHomepageBrick(?string $entity, string $fileLang, string $layout = 'attachments')
		{
			$files = $this->attachmentsManager->getAttachments(
				$entity,
				$createdBy = null,
				$published = true,
				$fileLayoutPosition = 'homepage',
				(string)$fileClass = null,
				$fileLang
			);

			return $this->render('attachment/' . $layout . '.html.twig', array(
				'files' => $files
			));
		}
	}