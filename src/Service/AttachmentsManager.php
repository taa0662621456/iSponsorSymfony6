<?php
	declare(strict_types=1);

	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;
	use Psr\Container\ContainerInterface;
	use Symfony\Component\Filesystem\Filesystem;

	class AttachmentsManager
	{
		/**
		 * @var EntityManagerInterface
		 */
		private EntityManagerInterface $entityManager;
		/**
		 * @var ContainerInterface
		 */
		private ContainerInterface $container;

		public function __construct(ContainerInterface $container,
									EntityManagerInterface $entityManager)
		{
			$this->container = $container;
			$this->entityManager = $entityManager;

		}

		public function getUploadsDirectory()
		{

			return $this->container->getParameter('uploads');

		}

		/**
		 * @param string|null $entity
		 * @param int|null    $id
		 * @param string|null $slug
		 * @param int|null    $createdBy
		 * @param bool|true   $published
		 * @param string|null $fileLayoutPosition
		 * @param string|null $fileClass
		 * @param string|null $fileLang
		 *
		 * @return object[]
		 */
		public function getAttachments(string $entity = null,
									   int $id = null,
									   string $slug = null,
									   int $createdBy = null,
									   bool $published = true,
									   string $fileLayoutPosition = null,
									   string $fileClass = null,
									   string $fileLang = null)
		{

			$repository = $this->entityManager->getRepository($entity);
			return $repository->findBy(
				array(
					'id'                 => $id ?: null,
					'slug'               => $slug ?: null,
					'createdBy'          => $createdBy ?: null,
					'published'          => $published ?: true,
					'fileLayoutPosition' => $fileLayoutPosition ?: 'file_layout_position',
					'fileClass'          => $fileClass ?: 'file_class',
					'fileLang'           => $fileLang ?: 'file_lang',
				),
				array(
					'createdOn' => 'ASC'
				),
				12,
				null
			);
		}

		public function removeAttachment(?string $filename)
		{
			if (!empty($filename)) {
				$filesystem = new Filesystem();
				$filesystem->remove($this->getUploadsDirectory() . $filename);
			}
		}
	}