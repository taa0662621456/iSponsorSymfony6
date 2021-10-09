<?php
	declare(strict_types=1);

	namespace App\Service;

	use App\Entity\Order\Orders;
	use App\Entity\Order\OrdersItems;
	use App\Entity\Product\Products;
	use App\Entity\Vendor\Vendors;
	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\OptimisticLockException;
	use Doctrine\ORM\ORMException;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

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
