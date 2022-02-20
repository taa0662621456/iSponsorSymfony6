<?php


	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\DependencyInjection\ContainerInterface;


	class FavouriteManager
	{
		/**
		 * @var ContainerInterface
		 */
		private ContainerInterface $container;
		/**
		 * @var EntityManagerInterface
		 */
		private EntityManagerInterface $entityManager;

		public function __construct(ContainerInterface $container, EntityManagerInterface $entityManager)
		{
			$this->container = $container;
			$this->entityManager = $entityManager;
		}

		/**
		 * @param string $entity
		 * @param object $createdBy
		 *
		 * @return void
		 */
		public function setFavourite(string $entity, object $createdBy)
		{
			//TODO
		}


		/**
		 * @param string $entity
		 * @param object $createdBy
		 *
		 * @return array
		 */
		public function getFavourites(string $entity, object $createdBy): array
        {

			$repository = $this->entityManager->getRepository($entity);

			return $repository->findBy(array(
				'createdBy' => $createdBy
			), array(
				'createdAt' => 'ASC'
			), 12, null);
		}

		public function removeFavourite()
		{

		}
	}
