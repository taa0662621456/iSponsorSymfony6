<?php


	namespace App\Controller\Vendor;


	use App\Service\AttachmentsManager;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;

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
		 * @param string      $entity
		 * @param bool|true   $published
		 * @param string|null $fileLayoutPosition
		 * @param string|null $fileClass
		 * @param string|null $fileLang
		 *
		 * @return Response
		 */
		public function getVendorAttachments(string $entity, bool $published, string $fileLayoutPosition, string $fileClass, string $fileLang)
		{
			$createdBy = $this->getUser();
			$files = $this->attachmentsManager->getAttachments($entity, $createdBy, $published, $fileLayoutPosition, $fileClass, $fileLang);


			return $this->render('attachment/attachments.html.twig', array(
				'files' => $files
			));
		}
	}