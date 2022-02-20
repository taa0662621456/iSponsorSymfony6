<?php


	namespace App\Listener;

	use App\Repository\AttachmentRepository;
	use App\Service\AttachmentsManager;
	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Event\PreUpdateEventArgs;

	class AttachmentManagerListener
	{
		public function __construct(private EntityManagerInterface $entityManager, private AttachmentRepository $attachmentRepository, private AttachmentsManager $attachmentsManager)
		{
		}

		public function preUpdate($entityManager, PreUpdateEventArgs $args)
		{
			$post = null;
			if ($args->hasChangedField('attachment')) {

				$em = $args->getEntityManager();
				$attachmentRepository = $em->getRepository($entityManager);
				/** @var  AttachmentRepository $attachmentRepository */
				$regex = '~/upload/[a-zA-Z0-9]+\.\w+~';
				$matches = [];

				if (preg_match_all($regex, $args->getNewValue('content'), $matches) > 0) {

					$filenames = array_map(
						fn($match) => basename($match), $matches[0]
					);

					$recordsToRemove = $this->attachmentRepository->findAttachmentsToRemove(
						$filenames, $entityManager->getId()
					);

					/** @var Attachment $record */
					foreach ($recordsToRemove as $record) {
						$this->entityManager->remove($record);
						$this->attachmentsManager->removeAttachment($record->getFileName());
					}
				} else if ($post->getAttachments()->count() && $matches) {
					/** @var Attachment $record */
					foreach ($post->getAttachments() as $record) {
						$entity = $this->entityManager->merge($record);
						$this->entityManager->remove($entity);
						$this->attachmentsManager->removeAttachment($record->getFilename());
					}
				}
				$this->entityManager->flush();
			}
		}
	}
