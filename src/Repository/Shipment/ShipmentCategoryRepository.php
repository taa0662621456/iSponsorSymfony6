<?php

namespace App\Repository\Shipment;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Shipment\Shipment;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Shipment\ShipmentCategoryRepositoryInterface;

/**
 * @method Shipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipment[]    findAll()
 * @method Shipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentCategoryRepository extends EntityRepository implements ShipmentCategoryRepositoryInterface
{
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o');
    }
}
