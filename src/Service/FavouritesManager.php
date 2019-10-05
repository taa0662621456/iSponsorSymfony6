<?php
	declare(strict_types=1);

	namespace App\Service;

	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Component\DependencyInjection\ContainerInterface;


	class FavouritesManager
	{
		/**
		 * @var ContainerInterface
		 */
		private $container;
		/**
		 * @var EntityManagerInterface
		 */
		private $entityManager;

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
		public function setFavourite(string $entity, $createdBy)
		{
			//TODO
		}


		/**
		 * @param string $entity
		 * @param object $createdBy
		 *
		 * @return array
		 */
		public function getFavourites(string $entity, $createdBy)
		{

			$repository = $this->entityManager->getRepository($entity);

			return $repository->findBy(array(
				'createdBy' => $createdBy
			), array(
				'createdOn' => 'ASC'
			), 12, null);
		}

		public function removeFavourite()
		{

		}
	}
