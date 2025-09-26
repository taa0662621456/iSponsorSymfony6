<?php

namespace App\Repository\Order;

use App\Entity\Order\OrderStorage;
use App\Entity\Project\Project;

use App\Entity\Vendor\Vendor;
use App\Interface\CustomerInterface;
use App\Interface\Vendor\VendorInterface;
use App\Interface\Order\OrderInterface;
use App\Service\AssociationHydrate;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Laminas\Code\Reflection\DocBlock\TagManager;
use function count;

/**
 * @method OrderStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStorage[]    findAll()
 * @method OrderStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends EntityRepository
//class OrderRepository extends ServiceEntityRepository
{
    /** @var AssociationHydrate */
    protected AssociationHydrate $associationHydrate;

    /**
     * ProjectsRepository constructor.
     */
    public function __construct(ManagerRegistry $registry, EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct();

        $this->associationHydrate = new AssociationHydrate($entityManager, $class);
    }

    /**
     *
     */

    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('customer')
            ->leftJoin('o.customer', 'customer')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ;
    }

    public function createSearchListQueryBuilder(): QueryBuilder
    {
        return $this->createListQueryBuilder()
            ->leftJoin('o.items', 'item')
            ->leftJoin('item.variant', 'variant')
            ->leftJoin('variant.product', 'product')
            ;
    }

    public function createByCustomerIdQueryBuilder($customerId): QueryBuilder
    {
        return $this->createListQueryBuilder()
            ->andWhere('o.customer = :customerId')
            ->setParameter('customerId', $customerId)
            ;
    }

    public function createByCustomerAndChannelIdQueryBuilder($customerId, $vendorId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customerId')
            ->andWhere('o.vendor = :vendorId')
            ->andWhere('o.state != :state')
            ->setParameter('customerId', $customerId)
            ->setParameter('vendorId', $vendorId)
            ->setParameter('state', OrderInterface::STATE_CART)
            ;
    }

    public function findByCustomer(CustomerInterface $customer): array
    {
        return $this->createByCustomerIdQueryBuilder($customer->getId())
            ->getQuery()
            ->getResult()
            ;
    }

    public function findForCustomerStatistics(CustomerInterface $customer): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customerId')
            ->andWhere('o.state = :state')
            ->setParameter('customerId', $customer->getId())
            ->setParameter('state', OrderInterface::STATE_FULFILLED)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneForPayment($id): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('payments')
            ->addSelect('paymentMethods')
            ->leftJoin('o.payments', 'payments')
            ->leftJoin('payments.method', 'paymentMethods')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countByCustomerAndCoupon(
        CustomerInterface $customer,
        PromotionCouponInterface $coupon,
        bool $includeCancelled = false,
    ): int {
        $states = [OrderInterface::STATE_CART];
        if ($coupon->isReusableFromCancelledOrders()) {
            $states[] = OrderInterface::STATE_CANCELLED;
        }

        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.promotionCoupon = :coupon')
            ->andWhere('o.state NOT IN (:states)')
            ->setParameter('customer', $customer)
            ->setParameter('coupon', $coupon)
            ->setParameter('states', $states)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function countByCustomer(CustomerInterface $customer): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.state NOT IN (:states)')
            ->setParameter('customer', $customer)
            ->setParameter('states', [OrderInterface::STATE_CART, OrderInterface::STATE_CANCELLED])
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function findOneByNumberAndCustomer(string $number, CustomerInterface $customer): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.number = :number')
            ->setParameter('customer', $customer)
            ->setParameter('number', $number)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCartByChannel($id, VendorInterface $vendor): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findLatestCartByChannelAndCustomer(VendorInterface $vendor, CustomerInterface $customer): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.customer = :customer')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->setParameter('customer', $customer)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findLatestNotEmptyCartByChannelAndCustomer(
        VendorInterface $vendor,
        CustomerInterface $customer,
    ): ?OrderInterface {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.items IS NOT EMPTY')
            ->andWhere('o.createdByGuest = :createdByGuest')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->setParameter('customer', $customer)
            ->setParameter('createdByGuest', false)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function getTotalSalesForChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('SUM(o.total)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderInterface::STATE_FULFILLED)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getTotalPaidSalesForChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('SUM(o.total)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderPaymentStates::STATE_PAID)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getTotalPaidSalesForChannelInPeriod(
        VendorInterface $vendor,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
    ): int {
        return (int) $this->createQueryBuilder('o')
            ->select('SUM(o.total)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->andWhere('o.checkoutCompletedAt >= :startDate')
            ->andWhere('o.checkoutCompletedAt <= :endDate')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderPaymentStates::STATE_PAID)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function countFulfilledByChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderInterface::STATE_FULFILLED)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function countPaidByChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderPaymentStates::STATE_PAID)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function countPaidForChannelInPeriod(
        VendorInterface $vendor,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
    ): int {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->andWhere('o.checkoutCompletedAt >= :startDate')
            ->andWhere('o.checkoutCompletedAt <= :endDate')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderPaymentStates::STATE_PAID)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function findLatestInChannel(int $count, VendorInterface $vendor): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state != :state')
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOrdersUnpaidSince(\DateTimeInterface $terminalDate): array
    {
        return $this->createQueryBuilder('o')
            ->where('o.checkoutState = :checkoutState')
            ->andWhere('o.paymentState = :paymentState')
            ->andWhere('o.state = :orderState')
            ->andWhere('o.checkoutCompletedAt < :terminalDate')
            ->setParameter('checkoutState', OrderCheckoutStates::STATE_COMPLETED)
            ->setParameter('paymentState', OrderPaymentStates::STATE_AWAITING_PAYMENT)
            ->setParameter('orderState', OrderInterface::STATE_NEW)
            ->setParameter('terminalDate', $terminalDate)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCartForSummary($id): ?OrderInterface
    {
        /** @var OrderInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($order, [
            'adjustments',
            'items',
            'items.adjustments',
            'items.units',
            'items.units.adjustments',
            'items.variant',
            'items.variant.optionValues',
            'items.variant.optionValues.translations',
            'items.variant.product',
            'items.variant.product.translations',
            'items.variant.product.images',
            'items.variant.product.options',
            'items.variant.product.options.translations',
        ]);

        return $order;
    }

    public function findCartForAddressing($id): ?OrderInterface
    {
        /** @var OrderInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartForSelectingShipping($id): ?OrderInterface
    {
        /** @var OrderInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartForSelectingPayment($id): ?OrderInterface
    {
        /** @var OrderInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartByTokenValue(string $tokenValue): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCartByTokenValueAndChannel(string $tokenValue, VendorInterface $vendor): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->andWhere('o.vendor = :vendor')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }



    /**
     *
     */
    public function countPlacedOrders(): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function createCartQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('vendor')
            ->addSelect('customer')
            ->innerJoin('o.vendor', 'vendor')
            ->leftJoin('o.customer', 'customer')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ;
    }

    public function findLatest(int $count): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findLatestCart(): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findOneByNumber(string $number): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->andWhere('o.number = :number')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('number', $number)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findOneByTokenValue(string $tokenValue): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCartById($id): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCartsNotModifiedSince(\DateTimeInterface $terminalDate): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.updatedAt < :terminalDate')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('terminalDate', $terminalDate)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllExceptCarts(): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     *
     */


    /**
     * @param TagManager|null $tag
     */
    public function findLatestSyl(int $page = 1, TagManager $tag = null): Paginator
    {

        $qb = $this->createQueryBuilder('p')
            ->addSelect('a', 't')
            ->innerJoin('p.vendorId', 'a')
            ->leftJoin('p.tags', 't')
            ->where('p.createdAt <= :now')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('now', new DateTime())
        ;

        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF p.tags')
                ->setParameter('tag', $tag);
        }
        return (new Paginator($qb))->paginate($page);

    }

    /**
     * @return Project[]
     */
    public function findBySearchQuery(string $rawQuery, int $limit = OrderStorage::NUM_ITEMS): array
    {

        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);
        if (0 === count($searchTerms)) {
            return [];
        }
        $queryBuilder = $this->createQueryBuilder('p');
        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.name LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
        }
        return $queryBuilder
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    /**
     * Removes all non-alphanumeric characters except whitespaces.
     */
    private function sanitizeSearchQuery(string $query): string
    {
        return trim(preg_replace('/[[:space:]]+/', ' ', $query));
    }

    /**
     * Splits the search query into terms and removes the ones which are irrelevant.
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $terms = array_unique(explode(' ', $searchQuery));
        return array_filter($terms, static fn($term) => 2 <= mb_strlen($term));
    }

    public function countForVendor(Vendor $vendor): int
    {
        return (int)$this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.orderVendor = :vendor')
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function sumTotalForVendor(Vendor $vendor): float
    {
        return (float)$this->createQueryBuilder('o')
            ->select('COALESCE(SUM(o.orderTotal), 0)')
            ->andWhere('o.orderVendor = :vendor')
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countByStatus(Vendor $vendor): array
    {
        return $this->createQueryBuilder('o')
            ->select('IDENTITY(o.orderStatus) AS status, COUNT(o.id) AS cnt')
            ->andWhere('o.orderVendor = :vendor')
            ->groupBy('o.orderStatus')
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getArrayResult();
    }

    public function findLatestForVendor(Vendor $vendor, int $limit = 5): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.orderVendor = :vendor')
            ->setParameter('vendor', $vendor)
            ->orderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Orders[] Returns an array of Orders objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */



    /*
    public function findOneBySomeField($value): ?Orders
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    #MustBe:
    #TODO: findByVendorId
    #TODO: findBySessionId

    public function findLatestSyli(int $count): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneByCustomer($id, CustomerInterface $customer): ?OrderItemUnitInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.orderItem', 'orderItem')
            ->innerJoin('orderItem.order', 'ord')
            ->innerJoin('ord.customer', 'customer')
            ->andWhere('o.id = :id')
            ->andWhere('customer = :customer')
            ->setParameter('id', $id)
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findOneByIdAndCustomer($id, CustomerInterface $customer): ?OrderItemInterface
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


}
