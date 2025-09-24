<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorIban;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\RepositoryInterface\Vendor\VendorIbanRepositoryInterface;

/**
 * @method VendorIban|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorIban|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorIban[]    findAll()
 * @method VendorIban[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorIbanRepository extends EntityRepository implements VendorIbanRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorIban::class);
    }
}