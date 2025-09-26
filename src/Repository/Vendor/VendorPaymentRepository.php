<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorPayment;
use Doctrine\ORM\EntityRepository;

/**
 * @method VendorPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorPayment[]    findAll()
 * @method VendorPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorPaymentRepository extends EntityRepository
{

}
