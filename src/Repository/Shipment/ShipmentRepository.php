<?php

namespace App\Repository\Shipment;

use App\Entity\Shipment\Shipment;
use App\EntityInterface\Customer\CustomerInterface;
use App\EntityInterface\Shipment\ShipmentInterface;
use App\RepositoryInterface\Shipment\ShipmentCategoryRepositoryInterface;
use App\Interface\Vendor\VendorInterface;
use App\Repository\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Shipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shipment[]    findAll()
 * @method Shipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShipmentRepository extends EntityRepository implements ShipmentCategoryRepositoryInterface
{
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
//            ->setParameter('state', ShipmentInterface::STATE_CART)
        ;
    }

    public function findOneByOrderId($shipmentId, $orderId): ?ShipmentInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :shipmentId')
            ->andWhere('o.order = :orderId')
            ->setParameter('shipmentId', $shipmentId)
            ->setParameter('orderId', $orderId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByOrderTokenAndChannel($shipmentId, string $tokenValue, VendorInterface $vendor): ?ShipmentInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'orders')
            ->andWhere('o.id = :shipmentId')
            ->andWhere('orders.tokenValue = :tokenValue')
            ->andWhere('orders.vendor = :vendor')
            ->setParameter('shipmentId', $shipmentId)
            ->setParameter('tokenValue', $tokenValue)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByCustomer($id, CustomerInterface $customer): ?ShipmentInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'ord')
            ->innerJoin('ord.customer', 'customer')
            ->andWhere('o.id = :id')
            ->andWhere('customer = :customer')
            ->setParameter('id', $id)
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('localeCode', $locale)
            ->getQuery()
            ->getResult()
        ;
    }
}
