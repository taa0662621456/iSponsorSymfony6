<?php

namespace App\Repository\Order;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Project\Project;

use App\Entity\Order\OrderStorage;
use Doctrine\ORM\NoResultException;
use App\Repository\EntityRepository;
use Symfony\Component\Workflow\Registry;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\EntityAssociationHydrator;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\EntityInterface\Order\OrderStorageInterface;
use App\EntityInterface\Vendor\VendorInterface;
use Laminas\Code\Reflection\DocBlock\TagManager;
use App\EntityInterface\Order\OrderItemInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use App\EntityInterface\Customer\CustomerInterface;
use Symfony\Component\Console\Exception\LogicException;
use App\EntityInterface\Promotion\PromotionCouponInterface;
use App\RepositoryInterface\Order\OrderItemRepositoryInterface;

/**
 * @method OrderStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStorage[]    findAll()
 * @method OrderStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends EntityRepository implements OrderItemRepositoryInterface
{
    protected EntityAssociationHydrator $entityAssociationHydrator;

    private Registry $workflowRegistry;

    public function __construct(ManagerRegistry $registry, Registry $workflowRegistry, EntityAssociationHydrator $associationHydrate)
    {
        parent::__construct($registry);
        $this->workflowRegistry = $workflowRegistry;
        $this->entityAssociationHydrator = $associationHydrate;
    }

    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('customer')
            ->leftJoin('o.customer', 'customer')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART);
    }

    public function createSearchListQueryBuilder(): QueryBuilder
    {
        return $this->createListQueryBuilder()
            ->leftJoin('o.items', 'item')
            ->leftJoin('item.variant', 'variant')
            ->leftJoin('variant.product', 'product');
    }

    public function createByCustomerIdQueryBuilder($customerId): QueryBuilder
    {
        return $this->createListQueryBuilder()
            ->andWhere('o.customer = :customerId')
            ->setParameter('customerId', $customerId);
    }

    public function createByCustomerAndChannelIdQueryBuilder($customerId, $vendorId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customerId')
            ->andWhere('o.vendor = :vendorId')
            ->andWhere('o.state != :state')
            ->setParameter('customerId', $customerId)
            ->setParameter('vendorId', $vendorId)
            ->setParameter('state', OrderStorageInterface::STATE_CART);
    }

    public function findByCustomer(CustomerInterface $customer): array
    {
        return $this->createByCustomerIdQueryBuilder($customer->getId())
            ->getQuery()
            ->getResult();
    }

    public function findForCustomerStatistics(CustomerInterface $customer): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customerId')
            ->andWhere('o.state = :state')
            ->setParameter('customerId', $customer->getId())
            ->setParameter('state', OrderStorageInterface::STATE_FULFILLED)
            ->getQuery()
            ->getResult();
    }

    public function findOneForPayment($id): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('payments')
            ->addSelect('paymentMethods')
            ->leftJoin('o.payments', 'payments')
            ->leftJoin('payments.method', 'paymentMethods')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
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
        $states = ['cart'];
        if ($coupon->isReusableFromCancelledOrders()) {
            $states[] = 'cancelled';
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
            ->getSingleScalarResult();
    }

    public function countByCustomer(CustomerInterface $customer): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.state NOT IN (:states)')
            ->setParameter('customer', $customer)
            ->setParameter('states', [OrderStorageInterface::STATE_CART, OrderStorageInterface::STATE_CANCELLED])
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findOneByNumberAndCustomer(string $number, CustomerInterface $customer): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.number = :number')
            ->setParameter('customer', $customer)
            ->setParameter('number', $number)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCartByChannel($id, VendorInterface $vendor): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->setParameter('id', $id)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLatestCartByChannelAndCustomer(VendorInterface $vendor, CustomerInterface $customer): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.customer = :customer')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->setParameter('customer', $customer)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLatestNotEmptyCartByChannelAndCustomer(
        VendorInterface $vendor,
        CustomerInterface $customer,
    ): ?OrderStorageInterface {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.customer = :customer')
            ->andWhere('o.items IS NOT EMPTY')
            ->andWhere('o.createdByGuest = :createdByGuest')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('vendor', $vendor)
            ->setParameter('customer', $customer)
            ->setParameter('createdByGuest', false)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getTotalSalesForChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('SUM(o.total)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderStorageInterface::STATE_FULFILLED)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getTotalPaidSalesForChannel(VendorInterface $vendor, WorkflowInterface $workflow): int
    {
        try {
            $queryBuilder = $this->createQueryBuilder('o');

            $queryBuilder
                ->select('SUM(o.total)')
                ->andWhere('o.vendor = :vendor')
                ->andWhere('o.paymentState = :state')
                ->setParameter('vendor', $vendor)
                ->setParameter('state', 'payment_confirmed');

            $orders = $queryBuilder->getQuery()->getResult();

            $totalPaidSales = 0;

            foreach ($orders as $order) {
                if ($workflow->can($order, 'payment_confirmation')) {
                    $totalPaidSales += $order->getTotal();
                }
            }

            return (int) $totalPaidSales;
        } catch (LogicException $e) {
            // Обработка ошибок рабочего процесса
        }

        return 0;
    }

    public function getTotalPaidSalesForChannelInPeriod(
        VendorInterface $vendor,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        WorkflowInterface $workflow
    ): int {
        try {
            $queryBuilder = $this->createQueryBuilder('o');

            $queryBuilder
                ->select('SUM(o.total)')
                ->andWhere('o.vendor = :vendor')
                ->andWhere('o.checkoutCompletedAt >= :startDate')
                ->andWhere('o.checkoutCompletedAt <= :endDate')
                ->setParameter('vendor', $vendor)
                ->setParameter('startDate', $startDate)
                ->setParameter('endDate', $endDate);

            $orders = $queryBuilder->getQuery()->getResult();

            $totalPaidSales = 0;

            foreach ($orders as $order) {
                if ($workflow->can($order, 'payment_confirmation')) {
                    $totalPaidSales += $order->getTotal();
                }
            }

            return (int) $totalPaidSales;
        } catch (LogicException $e) {
            // Обработка ошибок рабочего процесса
        }

        return 0;
    }

    public function countFulfilledByChannel(VendorInterface $vendor): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderStorageInterface::STATE_FULFILLED)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countPaidByChannel(VendorInterface $vendor): int
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', $this->getPaymentStateByName('paid'));

        // Добавляем workflow-фильтр для состояния заказа
        $queryBuilder->andWhere('o.workflowPlace = :workflowPlace')
            ->setParameter('workflowPlace', $this->getWorkflowPlaceByName('paid'));

        return (int) $queryBuilder->getQuery()->getSingleScalarResult();
    }

    private function getPaymentStateByName(string $name): int
    {
        // Здесь нужно реализовать логику для получения ID состояния по его имени из YAML-файла
        // Возвращаем ID состояния или выбрасываем исключение, если состояние не найдено
        return 0;
    }

    private function getWorkflowPlaceByName(string $name): string
    {
        // Здесь нужно реализовать логику для получения названия места в workflow по его имени из YAML-файла
        // Возвращаем название места или выбрасываем исключение, если место не найдено
        return 'paid';
    }

    public function countPaidForChannelInPeriod(
        VendorInterface $vendor,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
    ): int {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->select('COUNT(o.id)')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.paymentState = :state')
            ->andWhere('o.checkoutCompletedAt >= :startDate')
            ->andWhere('o.checkoutCompletedAt <= :endDate')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', $this->getPaymentStateByName('paid'))
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate);

        // Добавляем workflow-фильтр для состояния заказа
        $queryBuilder->andWhere('o.workflowPlace = :workflowPlace')
            ->setParameter('workflowPlace', $this->getWorkflowPlaceByName('paid'));

        return (int) $queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function findLatestInChannel(int $count, VendorInterface $vendor): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.vendor = :vendor')
            ->andWhere('o.state != :state')
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->setParameter('vendor', $vendor)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

    public function findOrdersUnpaidSince(\DateTimeInterface $date): array
    {
        try {
            $orders = $this->createQueryBuilder('o')
                ->where('o.updatedAt < :date')
                ->setParameter('date', $date)
                ->getQuery()
                ->getResult();

            $unpaidOrders = [];

            foreach ($orders as $order) {
                if ($this->workflow->can($order, 'checkout')) {
                    $unpaidOrders[] = $order;
                }
            }

            return $unpaidOrders;
        } catch (LogicException $e) {
            // Обработка ошибок рабочего процесса
        }

        return [];
    }

    public function findCartForSummary($id): void
    {
        /** @var OrderStorageInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult();

        $this->entityAssociationHydrator->hydrateAssociations($order, [
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
    }

    public function findCartForAddressing($id): ?OrderStorageInterface
    {
        /** @var OrderStorageInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult();

        $this->entityAssociationHydrator->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartForSelectingShipping($id): ?OrderStorageInterface
    {
        /** @var OrderStorageInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult();

        $this->entityAssociationHydrator->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartForSelectingPayment($id): ?OrderStorageInterface
    {
        /** @var OrderStorageInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult();

        $this->entityAssociationHydrator->hydrateAssociations($order, [
            'items',
            'items.variant',
            'items.variant.product',
            'items.variant.product.translations',
        ]);

        return $order;
    }

    public function findCartByTokenValue(string $tokenValue): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCartByTokenValueAndChannel(string $tokenValue, VendorInterface $vendor): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->andWhere('o.vendor = :vendor')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countPlacedOrders(): int
    {
        return (int) $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function createCartQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('vendor')
            ->addSelect('customer')
            ->innerJoin('o.vendor', 'vendor')
            ->leftJoin('o.customer', 'customer')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART);
    }

    public function findLatest(int $count): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

    public function findLatestCart(): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->addOrderBy('o.checkoutCompletedAt', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByNumber(string $number): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->andWhere('o.number = :number')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('number', $number)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByTokenValue(string $tokenValue): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->andWhere('o.tokenValue = :tokenValue')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('tokenValue', $tokenValue)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCartById($id): ?OrderStorageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findCartsNotModifiedSince(\DateTimeInterface $terminalDate): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.updatedAt < :terminalDate')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->setParameter('terminalDate', $terminalDate)
            ->getQuery()
            ->getResult();
    }

    public function findAllExceptCarts(): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', OrderStorageInterface::STATE_CART)
            ->getQuery()
            ->getResult();
    }

    public function findLatestSyl(int $page = 1, TagManager $tag = null): Paginator
    {
        $qb = $this->createQueryBuilder('p')
            ->addSelect('a', 't')
            ->innerJoin('p.vendorId', 'a')
            ->leftJoin('p.tags', 't')
            ->where('p.createdAt <= :now')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('now', new \DateTime());

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
        if (0 === \count($searchTerms)) {
            return [];
        }
        $queryBuilder = $this->createQueryBuilder('p');
        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.name LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%');
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

        return array_filter($terms, static fn ($term) => 2 <= mb_strlen($term));
    }

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySomeField($value): ?OrderStorage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // MustBe:
    // TODO: findBySessionId
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
            ->getOneOrNullResult();
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
            ->getOneOrNullResult();
    }
}
