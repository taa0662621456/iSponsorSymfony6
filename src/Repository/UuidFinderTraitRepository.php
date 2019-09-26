<?php

	namespace App\Repository;

	use App\Doctrine\UuidEncoder;

	trait UuidFinderTraitRepository
	{
		/**
		 * @var UuidEncoder
		 */
		protected $uuidEncoder;

		public function findOneByEncodedUuid(string $encodedUuid)
		{
			return $this->findOneBy([
				'uuid' => $this->uuidEncoder->decode($encodedUuid)
			]);
		}
	}