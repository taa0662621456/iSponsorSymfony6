<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorShipment;
use Doctrine\ORM\EntityRepository;

/**
 * @method VendorShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorShipment[]    findAll()
 * @method VendorShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorShipmentRepository extends EntityRepository
{

}
