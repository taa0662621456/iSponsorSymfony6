<?php
	declare(strict_types=1);

	namespace App\Controller;

	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;

	class AttachmentsController extends AbstractController
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
		 * @param         $entity
		 * @param         $published
		 * @param         $fileTemplatePosition
		 * @param         $fileClass
		 * @param         $fileLang
		 *
		 * @return Response
		 */
		public function getAttachments($entity, $published, $fileTemplatePosition, $fileClass, $fileLang)
		{
			$createdBy = $this->getUser();
			$files = $this->attachmentsManager->getAttachments($entity, $createdBy, $published, $fileTemplatePosition, $fileClass, $fileLang);


			return $this->render('attachment/attachments.html.twig', array(
				'files' => $files
			));
		}

	}