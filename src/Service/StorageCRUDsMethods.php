<?php
	declare(strict_types=1);

	namespace App\Service;

	use Doctrine\ORM\EntityManager;


	class StorageCRUDsMethods
	{
		/**
		 * @var EntityManager $em
		 */
		private $em;

		public function __construct(EntityManager $entityManager)
		{
			$this->em = $entityManager;
		}

        public function updateRemainder()
        {

		}
        public function decrementRemainder()
        {

		}
        public function incrementRemainder()
        {

		}



	}
