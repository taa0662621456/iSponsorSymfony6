<?php
	declare(strict_types=1);

	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
    use Symfony\Component\Filesystem\Filesystem;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

    class AttachmentsManager
	{
		/**
		 * @var EntityManagerInterface
		 */
		private EntityManagerInterface $entityManager;
        /**
         * @var RequestStack
         */
        private RequestStack $requestStack;
        /**
         * @var AuthorizationCheckerInterface
         */
        private AuthorizationCheckerInterface $authChecker;
        /**
         * @var ParameterBagInterface
         */
        private ParameterBagInterface $parameterBag;

        public function __construct(EntityManagerInterface $entityManager,
                                    RequestStack $requestStack,
                                    AuthorizationCheckerInterface $authChecker,
                                    ParameterBagInterface $parameterBag)
		{
			$this->entityManager = $entityManager;
			$this->requestStack = $requestStack;
			$this->authChecker = $authChecker;
			$this->parameterBag = $parameterBag;
		}

        /**
         * @return string|null
         */
        public function getUploadsDirectory(): ?string
        {
            $route = $this->requestStack->getMainRequest()->attributes->get('_route');
			return $this->parameterBag->get( $route . '_images_directory');

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
									   string $fileLang = null): array
        {

            $route = $this->requestStack->getMainRequest()->attributes->get('_route');
            if ($route == 'category' || // TODO: временно условие, чтобы на главной стр. не вытаскивались аттачменты
                $route == 'project' ||
                $route == 'product' ||
                $route == 'vendor_media' ||
                $route == 'vendor_document' ||
                $route == 'vendor' and
                false === $this->authChecker->isGranted('ROLE_ADMIN')) {
                $entity = 'App\Entity\\' . $route . '\\' . $route . 'Attachments';
                $id = null;
                $slug = null;
                $createdBy = null;
                $published = true;
                $fileLayoutPosition = $route;
                $fileClass = null;
                $fileLang = $route;
            }

			return $this->entityManager->getRepository($entity)->findBy(
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