<?php

	namespace App\Repository\Vendor;
	use App\Entity\Taxation\Taxation;
    use App\Entity\Vendor\Vendor;
    use App\RepositoryInterface\Vendor\VendorCodeStorageRepositoryInterface;
    use App\Repository\EntityRepository;
    /**
     * @method Vendor|null find($id, $lockMode = null, $lockVersion = null)
     * @method Vendor|null findOneBy(array $criteria, array $orderBy = null)
     * @method Vendor[]    findAll()
     * @method Vendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
    class VendorCodeStorageRepository extends EntityRepository implements VendorCodeStorageRepositoryInterface
	{

	}
