<?php

namespace App\Repository\Shipment;

use App\Entity\Shipment\Shipment;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Shipment\ShipmentEnUsRepositoryInterface;

/**
 * @method Shipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipment[]    findAll()
 * @method Shipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentEnUsRepository extends EntityRepository implements ShipmentEnUsRepositoryInterface
{
}