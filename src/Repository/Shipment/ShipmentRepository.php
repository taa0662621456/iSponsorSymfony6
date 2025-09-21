<?php

namespace App\Repository\Shipment;

use App\EntityInterface\Vendor\VendorInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Shipment\Shipment;
use App\Repository\EntityRepository;
use App\EntityInterface\Customer\CustomerInterface;
use App\EntityInterface\Shipment\ShipmentInterface;
use App\RepositoryInterface\Shipment\ShipmentCategoryRepositoryInterface;

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
            ->andWhere('o.state != :state');
        //            ->setParameter('state', ShipmentInterface::STATE_CART)
    }

    public function findOneByOrderId($shipmentId, $orderId): ?ShipmentInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.id = :shipmentId')
                ->andWhere('o.order = :orderId')
                ->setParameter('shipmentId', $shipmentId)
                ->setParameter('orderId', $orderId)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw $e;
        }
    }

    public function findOneByOrderTokenAndChannel($shipmentId, string $tokenValue, VendorInterface $vendor): ?ShipmentInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->innerJoin('o.order', 'orders')
                ->andWhere('o.id = :shipmentId')
                ->andWhere('orders.tokenValue = :tokenValue')
                ->andWhere('orders.vendor = :vendor')
                ->setParameter('shipmentId', $shipmentId)
                ->setParameter('tokenValue', $tokenValue)
                ->setParameter('vendor', $vendor)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        throw $e;
        }
    }

    public function findOneByCustomer($id, CustomerInterface $customer): ?ShipmentInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->innerJoin('o.order', 'ord')
                ->innerJoin('ord.customer', 'customer')
                ->andWhere('o.id = :id')
                ->andWhere('customer = :customer')
                ->setParameter('id', $id)
                ->setParameter('customer', $customer)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw $e;
        }
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
            ->getResult();
    }
}
