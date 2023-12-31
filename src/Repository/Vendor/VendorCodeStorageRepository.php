<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Vendor\VendorCodeStorageRepositoryInterface;

/**
 * @method Vendor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendor[]    findAll()
 * @method Vendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorCodeStorageRepository extends EntityRepository implements VendorCodeStorageRepositoryInterface
{
}
