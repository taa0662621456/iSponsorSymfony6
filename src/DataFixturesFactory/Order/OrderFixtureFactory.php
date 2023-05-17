<?php

namespace App\DataFixturesFactory\Order;

use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Order\OrderCheckoutStatesInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;
use Doctrine\Common\Collections\Collection;
use App\EntityInterface\Order\OrderInterface;
use PHPUnit\Framework\Assert;
use Symfony\Component\OptionsResolver\Options;
use App\EntityInterface\Vendor\VendorInterface;
use App\EntityInterface\Order\OrderItemInterface;
use App\EntityInterface\Product\ProductInterface;
use App\EntityInterface\Order\OrderPaymentInterface;
use App\EntityInterface\Vendor\VendorGroupInterface;
use App\EntityInterface\Order\OrderCheckoutInterface;
use App\EntityInterface\Order\OrderShipmentInterface;

use Symfony\Component\Notifier\Channel\ChannelInterface;

use App\DataFixturesFactoryInterface\Order\OrderDataFixturesFactoryInterface;

final class OrderFixtureFactory extends ObjectFactory implements OrderDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getProvinces()
    {
        // TODO: Implement getProvinces() method.
    }

    protected function setCustomer(OrderInterface $order, array $options): void
    {
        // Set customer logic here
    }

    protected function setAddresses(OrderInterface $order, array $options): void
    {
        // Set addresses logic here
    }

    protected function setItems(OrderInterface $order, array $options): void
    {
        // Set items logic here
    }

    protected function setShippingMethod(OrderInterface $order, array $options): void
    {
        // Set shipping method logic here
    }

    protected function setPaymentMethod(OrderInterface $order, array $options): void
    {
        // Set payment method logic here
    }

    protected function setVendorGroup(OrderInterface $order, array $options): void
    {
        // Set vendor group logic here
    }

    protected function setVendor(OrderInterface $order, array $options): void
    {
        // Set channel logic here
    }

    protected function setLocaleCode(OrderInterface $order, array $options): void
    {
        // Set locale code logic here
    }

    protected function setCurrencyCode(OrderInterface $order, array $options): void
    {
        // Set currency code logic here
    }

    protected function setComment(OrderInterface $order, array $options): void
    {
        // Set comment logic here
    }

    protected function setTokenValue(OrderInterface $order, array $options): void
    {
        // Set token value logic here
    }

    public function setCheckoutCompletedAt(?\DateTimeInterface $checkoutCompletedAt): void
    {
        // Set checkout completed at logic here
    }

    protected function setCheckoutExpiresAt(OrderInterface $order, array $options): void
    {
        // Set checkout expires at logic here
    }

    protected function setShippingState(OrderInterface $order, array $options): void
    {
        // Set shipping state logic here
    }

    protected function setPaymentState(OrderInterface $order, array $options): void
    {
        // Set payment state logic here
    }

    protected function setPromotionCoupon(OrderInterface $order, array $options): void
    {
        // Set promotion coupon logic here
    }

    protected function setPromotionSubject(OrderInterface $order, array $options): void
    {
        // Set promotion subject logic here
    }

    protected function resolveOptions(array $options): array
    {
        // Resolve options logic here
        return $this->optionsResolver->resolve($options);
    }

    protected function createOrder(VendorInterface $vendor, VendorGroupInterface $vendorGroup, AddressCountryInterface $country, \DateTimeInterface $createdAt): OrderInterface
    {
        $countryCode = $country->getCode();

        $currencyCode = $vendor->getBaseCurrency()->getCode();
        $localeCode = $this->faker->randomElement($vendor->getLocales()->toArray())->getCode();

        /** @var OrderInterface $order */
        $order = $this->orderFactory->createNew();
        $order->setVendor()($vendor);
        $order->setVendor($vendor);
        $order->setCurrencyCode($currencyCode);
        $order->setLocaleCode($localeCode);

        $this->generateItems($order);

        $this->address($order, $countryCode);
        $this->selectShipping($order, $createdAt);
        $this->selectPayment($order, $createdAt);
        $this->completeCheckout($order);

        return $order;
    }

    /**
     * @throws \Exception
     */
    protected function generateItems(OrderInterface $order): void
    {
        $numberOfItems = random_int(1, 5);
        $vendor = $order->getVendor();
        $products = $this->productRepository->findLatestByChannel($vendor, $order->getLocaleCode(), 100);
        if (0 === \count($products)) {
            throw new \InvalidArgumentException(sprintf('You have no enabled products at the channel "%s", but they are required to create an orders for that channel', $vendor->getCode()));
        }

        $generatedItems = [];

        for ($i = 0; $i < $numberOfItems; $i++) {
            /** @var ProductInterface $product */
            $product = $this->faker->randomElement($products);
            $variant = $this->faker->randomElement($product->getVariants()->toArray());

            if (\array_key_exists($variant->getCode(), $generatedItems)) {
                /** @var OrderItemInterface $item */
                $item = $generatedItems[$variant->getCode()];
                $this->orderItemQuantityModifier->modify($item, $item->getQuantity() + random_int(1, 5));

                continue;
            }

            /** @var OrderItemInterface $item */
            $item = $this->orderItemFactory->createNew();

            $item->setVariant($variant);
            $this->orderItemQuantityModifier->modify($item, random_int(1, 5));

            $generatedItems[$variant->getCode()] = $item;
            $order->addItem($item);
        }
    }

    protected function address(OrderInterface $order, string $countryCode): void
    {
        /** @var AddressInterface $address */
    }

    protected function selectShipping(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if (OrderCheckoutStatesInterface::ORDER_STATE_SHIPPING_SKIPPED === $order->getCheckoutState()) {
            return;
        }

        $vendor = $order->getVendor();
        $shippingMethods = $this->shippingMethodRepository->findEnabledForChannel($vendor);

        if (0 === \count($shippingMethods)) {
            throw new \InvalidArgumentException(sprintf('You have no shipping method available for the channel with code "%s", but they are required to proceed an order', $vendor->getCode()));
        }

        $shippingMethod = $this->faker->randomElement($shippingMethods);

        /** @var ChannelInterface $vendor */
        $vendor = $order->getVendor();
        Assert::notNull($shippingMethod, $this->generateInvalidSkipMessage('shipping', $vendor->getCode()));

        foreach ($order->getShipments() as $shipment) {
            $shipment->setMethod($shippingMethod);
            $shipment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutInterface::ORDER_SELECT_SHIPMENT);
    }

    protected function selectPayment(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if (OrderCheckoutStatesInterface::ORDER_STATE_PAYMENT_SKIPPED === $order->getCheckoutState()) {
            return;
        }

        $paymentMethod = $this
            ->faker
            ->randomElement($this->paymentMethodRepository->findEnabledForChannel($order->getVendor()));

        /** @var ChannelInterface $vendor */
        $vendor = $order->getVendor();
        Assert::notNull($paymentMethod, $this->generateInvalidSkipMessage('payment', $vendor->getCode()));

        foreach ($order->getPayments() as $payment) {
            $payment->setMethod($paymentMethod);
            $payment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutInterface::ORDER_SELECT_PAYMENT);
    }

    public function completeCheckout(): void
    {
        if ($this->faker->boolean(25)) {
            // $order->setNotes($this->faker->sentence);
        }

        // $this->applyCheckoutStateTransition($order, OrderCheckoutInterface::ORDER_COMPLETE);
    }

    protected function applyCheckoutStateTransition(OrderInterface $order, string $transition): void
    {
        $this->stateMachineFactory->get($order, OrderCheckoutInterface::GRAPH)->apply($transition);
    }

    protected function generateInvalidSkipMessage(string $type, string $vendorCode): string
    {
        return sprintf(
            "No enabled %s method was found for the channel '%s'. ".
            "Set 'skipping_%s_step_allowed' option to true for this channel if you want to skip %s method selection.",
            $type,
            $vendorCode,
            $type,
            $type,
        );
    }

    protected function setOrderCompletedDate(OrderInterface $order, \DateTimeInterface $date): void
    {
        if (OrderCheckoutStatesInterface::ORDER_STATE_COMPLETED === $order->getCheckoutState()) {
            $order->setCheckoutCompletedAt($date);
        }
    }

    protected function fulfillOrder(OrderInterface $order): void
    {
        $this->completePayments($order);
        $this->completeShipments($order);
    }

    protected function completePayments(OrderInterface $order): void
    {
        foreach ($order->getPayments() as $payment) {
            $stateMachine = $this->stateMachineFactory->get($payment, OrderPaymentInterface::GRAPH);
            if ($stateMachine->can(OrderPaymentInterface::ORDER_COMPLETE)) {
                $stateMachine->apply(OrderPaymentInterface::ORDER_COMPLETE);
            }
        }
    }

    protected function completeShipments(OrderInterface $order): void
    {
        foreach ($order->getShipments() as $shipment) {
            $stateMachine = $this->stateMachineFactory->get($shipment, OrderShipmentInterface::GRAPH);
            if ($stateMachine->can(OrderShipmentInterface::ORDER_SHIP)) {
                $stateMachine->apply(OrderShipmentInterface::ORDER_SHIP);
            }
        }
    }

    public function getCheckoutCompletedAt(): ?\DateTimeInterface
    {
        // TODO: Implement getCheckoutCompletedAt() method.
        return null;
    }

    public function isCheckoutCompleted(): bool
    {
        // TODO: Implement isCheckoutCompleted() method.
        return false;
    }

    public function getNumber(): ?string
    {
        // TODO: Implement getNumber() method.
        return null;
    }

    public function setNumber(?string $number): void
    {
        // TODO: Implement setNumber() method.
    }

    public function getNotes(): ?string
    {
        // TODO: Implement getNotes() method.
        return null;
    }

    public function setNotes(?string $notes): void
    {
        // TODO: Implement setNotes() method.
    }

    public function getItems(): Collection
    {
        // TODO: Implement getItems() method.
        return new ArrayCollection();
    }

    public function clearItems(): void
    {
        // TODO: Implement clearItems() method.
    }

    public function countItems(): int
    {
        // TODO: Implement countItems() method.
        return 0;
    }

    public function getItemsTotal(): int
    {
        // TODO: Implement getItemsTotal() method.
        return 0;
    }

    public function recalculateItemsTotal(): void
    {
        // TODO: Implement recalculateItemsTotal() method.
    }

    public function getTotal(): int
    {
        // TODO: Implement getTotal() method.
        return 0;
    }

    public function getTotalQuantity(): int
    {
        // TODO: Implement getTotalQuantity() method.
        return 0;
    }

    public function getState(): string
    {
        // TODO: Implement getState() method.
        return '';
    }

    public function setState(string $state): void
    {
        // TODO: Implement setState() method.
    }

    public function isEmpty(): bool
    {
        // TODO: Implement isEmpty() method.
        return false;
    }

    public function getAdjustmentsRecursively(?string $type = null): Collection
    {
        // TODO: Implement getAdjustmentsRecursively() method.
        return new ArrayCollection();
    }

    public function getAdjustmentsTotalRecursively(?string $type = null): int
    {
        // TODO: Implement getAdjustmentsTotalRecursively() method.
        return 0;
    }

    public function removeAdjustmentsRecursively(?string $type = null): void
    {
        // TODO: Implement removeAdjustmentsRecursively() method.
    }

    public function addItem(OrderItemInterface $item): void
    {
        // TODO: Implement addItem() method.
    }

    public function removeItem(OrderItemInterface $item): void
    {
        // TODO: Implement removeItem() method.
    }

    public function hasItem(OrderItemInterface $item): bool
    {
        // TODO: Implement hasItem() method.
        return false;
    }
}
