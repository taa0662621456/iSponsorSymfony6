<?php

namespace App\Service\Order\OrderShipment;

use App\Entity\Order\OrderStorage;
use App\Entity\Shipment\ShipmentMethod;
use App\Entity\Storage\Storage;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorAddress;
use App\EntityInterface\Vendor\VendorInterface;
use App\Repository\Order\OrderRepository;
use App\Repository\Shipment\ShipmentMethodRepository;
use App\Repository\Vendor\VendorRepository;
use App\Service\EmailService;
use App\ServiceInterface\Order\OrderShipmentMethodSelectionRequirementCheckerServiceInterface;
use DateTime;
use DateTimeInterface;
use Exception;
use Psr\Log\LoggerInterface;

/**
 * @property $entityManage
 */
class OrderShipmentMethodChecker implements OrderShipmentMethodSelectionRequirementCheckerServiceInterface
{
    private ShipmentMethodRepository $shipmentMethodRepository;

    private VendorRepository $vendorRepository;

    private OrderRepository $orderRepository;

    private LoggerInterface $logger;

    private EmailService $emailService;

    public function __construct(
        ShipmentMethodRepository $shipmentMethodRepository,
        VendorRepository         $vendorRepository,
        OrderRepository          $orderRepository,
        LoggerInterface          $logger,
        EmailService             $emailService
    )
    {
        $this->shipmentMethodRepository = $shipmentMethodRepository;
        $this->vendorRepository = $vendorRepository;
        $this->orderRepository = $orderRepository;
        $this->logger = $logger;
        $this->emailService = $emailService;
    }

    public function checkRequirementsForShipmentMethodSelection(int $orderId, int $shipmentMethodId): bool
    {
        try {
            $order = $this->orderRepository->findById($orderId);
            $shipmentMethod = $this->shipmentMethodRepository->findById($shipmentMethodId);

            // Perform various checks and validations
            if (!$order || !$shipmentMethod) {
                $this->logger->error('Invalid order or shipment method');

                return false;
            }

            if (!$this->isShipmentMethodAvailable($shipmentMethod)) {
                $this->logger->info('Selected shipment method is not available');

                return false;
            }

            if (!$this->isShipmentMethodSupported($shipmentMethod, $order->getUser())) {
                $this->logger->info('Selected shipment method is not supported for the user');

                return false;
            }

            // Additional business logic and checks can be added here

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function isShipmentMethodAvailable(ShipmentMethod $shipmentMethod): bool
    {
        return true;
    }

    private function isShipmentMethodSupported(ShipmentMethod $shipmentMethod, Vendor $vendor): bool
    {
        // Check if the shipment method is supported for the user, based on user-specific conditions
        // Return true if supported, false otherwise
        return true;
    }

    public function checkShipmentMethodCondition(OrderStorage $order, VendorInterface $vendor): bool
    {
        return true;
    }

    private function getOrderTotal(OrderStorage $order): float
    {
        // Метод для получения общей стоимости заказа из OrderStorage
        return true;
    }

    private function getShipmentAddress(VendorAddress $vendorAddress): string
    {
        // Метод для получения адреса доставки пользователя
        // Верните адрес доставки пользователя
        return true;
    }

    private function getAvailableShipmentMethod(): array
    {
        // Метод для получения доступных методов доставки
        // Извлеките данные из базы
        // Верните массив доступных методов доставки
        return [];
    }

    private function filterAvailableShipmentMethodsByCountry(array $shipmentMethods, string $country): array
    {
        // Метод для фильтрации доступных методов доставки по стране доставки
        // Пройдитесь по каждому методу доставки и примените фильтр
        // Верните отфильтрованный массив методов доставки
        return [];
    }

    private function getPreferredShipmentMethod(array $shipmentMethods): ?ShipmentMethod
    {
        return null;
    }

    private function checkOrderItemAvailability(OrderStorage $order): bool
    {
        $items = $this->getOrderItems(1);

        $orderItems = $order->getItems();

        return true;
    }

    public function getOrderItems(array $productIds): array
    {
        $itemRepository = $this->entityManager->getRepository(Storage::class);
        return $itemRepository->findBy(['id' => $productIds]);
    }

    public function checkOrderItem(int $productId): bool
    {

        $storageRepository = $this->entityManager->getRepository(Storage::class);
        $product = $storageRepository->findOneBy(['id' => $productId]);
        return $product !== null;
    }

    public function checkOrderItemStock(int $productId, int $quantity): bool
    {

        if ($this->checkOrderItem($productId)) {

            $product = $this->entityManager->getRepository(Storage::class)->find($productId);

            if ($product) {
                $currentQuantity = $product->getStorageStock();

                return $currentQuantity >= $quantity;
            }
        }
        return false;
    }



    private function calculateDeliveryDate(ShipmentMethod $shipmentMethod): DateTimeInterface
    {
        // Метод для расчета даты доставки на основе выбранного метода доставки
        // Реализуйте логику расчета даты доставки
        // Верните объект \DateTimeInterface с расчитанной датой доставки
        return new DateTime();
    }
}