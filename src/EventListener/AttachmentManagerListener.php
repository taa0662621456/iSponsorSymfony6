<?php


	namespace App\EventListener;

	use App\Entity\Attachment\Attachment;
    use App\Repository\Attachment\AttachmentRepository;
    use App\Service\AttachmentManager;
    use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Event\PreUpdateEventArgs;

	class AttachmentManagerListener
	{
		public function __construct(private readonly EntityManagerInterface $entityManager, private readonly AttachmentRepository $attachmentRepository, private readonly AttachmentManager $attachmentsManager)
		{
		}

		public function preUpdate($entityManager, PreUpdateEventArgs $args): void
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
						$entity = $entityManager->find(Attachment::class, $payload['id']);
						$this->entityManager->remove($entity);
						$this->attachmentsManager->removeAttachment($record->getFilename());
					}
				}
				$this->entityManager->flush();
			}
		}
	}
