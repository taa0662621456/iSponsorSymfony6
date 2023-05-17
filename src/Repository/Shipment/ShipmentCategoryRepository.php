<?php

namespace App\Repository\Shipment;

use App\Entity\Shipment\Shipment;
use App\RepositoryInterface\Shipment\ShipmentCategoryRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\ORM\QueryBuilder;
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
