<?php


namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorIban;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorIban|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorIban|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorIban[]    findAll()
 * @method VendorIban[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorIbanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorIban::class);
    }




}
