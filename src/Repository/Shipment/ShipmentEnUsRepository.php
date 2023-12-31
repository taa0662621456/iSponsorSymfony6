<?php

namespace App\Repository\Shipment;

use App\Entity\Shipment\Shipment;
use App\RepositoryInterface\Shipment\ShipmentEnUsRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method Shipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipment[]    findAll()
 * @method Shipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentEnUsRepository extends EntityRepository implements ShipmentEnUsRepositoryInterface
{

}