<?php

namespace App\Factory\Fixture\Order;

use App\Interface\Address\AddressCountryInterface;
use App\Interface\Address\AddressInterface;
use App\Interface\Customer\CustomerGroupInterface;
use App\Interface\FactoryInterface;
use App\Interface\Fixture\FixtureFactoryInterface;
use App\Interface\Order\OrderInterface;
use App\Interface\Order\OrderItemInterface;
use App\Interface\Order\OrderItemQuantityModifierInterface;
use App\Interface\Order\OrderPaymentMethodSelectionRequirementCheckerInterface;
use App\Interface\Order\OrderShipmentMethodSelectionRequirementCheckerInterface;
use App\Interface\Payment\PaymentMethodRepositoryInterface;
use App\Interface\Product\ProductInterface;
use App\Interface\Product\ProductRepositoryInterface;
use App\Interface\RepositoryInterface;
use App\Service\Fixture\AbstractFixtureFactory;
use App\Service\Sylius_OptionsResolver\LazyOption;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class OrderFixtureFactory extends AbstractFixtureFactory implements FixtureFactoryInterface
{
    /** @var OptionsResolver */
    protected OptionsResolver $optionsResolver;

    /** @var Generator */
    protected Generator $faker;

    public function __construct(
        protected FactoryInterface $orderFactory,
        protected FactoryInterface $orderItemFactory,
        protected OrderItemQuantityModifierInterface                      $orderItemQuantityModifier,
        protected ObjectManager                                           $orderManager,
        protected RepositoryInterface                                     $channelRepository,
        protected RepositoryInterface                                     $customerRepository,
        protected ProductRepositoryInterface                              $productRepository,
        protected RepositoryInterface                                     $countryRepository,
        protected PaymentMethodRepositoryInterface                        $paymentMethodRepository,
        protected ShippingMethodRepositoryInterface                       $shippingMethodRepository,
        protected FactoryInterface                                        $addressFactory,
        protected StateMachineFactoryInterface                            $stateMachineFactory,
        protected OrderShipmentMethodSelectionRequirementCheckerInterface $orderShippingMethodSelectionRequirementChecker,
        protected OrderPaymentMethodSelectionRequirementCheckerInterface  $orderPaymentMethodSelectionRequirementChecker,
    ) {
        parent::__construct();
        $this->optionsResolver = new OptionsResolver();
        $this->faker = Factory::create();
        $this->configureOptions($this->optionsResolver);
    }

    public function create(string $entityName, array $options = []): OrderInterface
    {
        $options = $this->optionsResolver->resolve($options);

        $order = $this->createOrder($options['channel'], $options['customer'], $options['country'], $options['complete_date']);
        $this->setOrderCompletedDate($order, $options['complete_date']);
        if ($options['fulfilled']) {
            $this->fulfillOrder($order);
        }

        return $order;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('amount', 20)

            ->setDefault('channel', LazyOption::randomOne($this->channelRepository))
            ->setAllowedTypes('channel', ['null', 'string', ChannelInterface::class])
            ->setNormalizer('channel', LazyOption::getOneBy($this->channelRepository, 'code'))

            ->setDefault('customer', LazyOption::randomOne($this->customerRepository))
            ->setAllowedTypes('customer', ['null', 'string', CustomerGroupInterface::class])
            ->setNormalizer('customer', LazyOption::getOneBy($this->customerRepository, 'email'))

            ->setDefault('country', LazyOption::randomOne($this->countryRepository))
            ->setAllowedTypes('country', ['null', 'string', AddressCountryInterface::class])
            ->setNormalizer('country', LazyOption::findOneBy($this->countryRepository, 'code'))

            ->setDefault('complete_date', fn (Options $options): \DateTimeInterface => $this->faker->dateTimeBetween('-1 years', 'now'))
            ->setAllowedTypes('complete_date', ['null', \DateTime::class])

            ->setDefault('fulfilled', false)
            ->setAllowedTypes('fulfilled', ['bool'])
        ;
    }

    protected function createOrder(ChannelInterface $channel, CustomerGroupInterface $customer, AddressCountryInterface $country, \DateTimeInterface $createdAt): OrderInterface
    {
        $countryCode = $country->getCode();

        $currencyCode = $channel->getBaseCurrency()->getCode();
        $localeCode = $this->faker->randomElement($channel->getLocales()->toArray())->getCode();

        /** @var OrderInterface $order */
        $order = $this->orderFactory->createNew();
        $order->setChannel($channel);
        $order->setCustomer($customer);
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
        $channel = $order->getChannel();
        $products = $this->productRepository->findLatestByChannel($channel, $order->getLocaleCode(), 100);
        if (0 === count($products)) {
            throw new \InvalidArgumentException(sprintf('You have no enabled products at the channel "%s", but they are required to create an orders for that channel', $channel->getCode()));
        }

        $generatedItems = [];

        for ($i = 0; $i < $numberOfItems; ++$i) {
            /** @var ProductInterface $product */
            $product = $this->faker->randomElement($products);
            $variant = $this->faker->randomElement($product->getVariants()->toArray());

            if (array_key_exists($variant->getCode(), $generatedItems)) {
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
        $address = $this->addressFactory->createNew();
        $address->setFirstName($this->faker->firstName);
        $address->setLastName($this->faker->lastName);
        $address->setStreet($this->faker->streetAddress);
        $address->setCountryCode($countryCode);
        $address->setCity($this->faker->city);
        $address->setPostcode($this->faker->postcode);

        $order->setShippingAddress($address);
        $order->setBillingAddress(clone $address);

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_ADDRESS);
    }

    protected function selectShipping(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if (OrderCheckoutStates::STATE_SHIPPING_SKIPPED === $order->getCheckoutState()) {
            return;
        }

        $channel = $order->getChannel();
        $shippingMethods = $this->shippingMethodRepository->findEnabledForChannel($channel);

        if (0 === count($shippingMethods)) {
            throw new \InvalidArgumentException(sprintf('You have no shipping method available for the channel with code "%s", but they are required to proceed an order', $channel->getCode()));
        }

        $shippingMethod = $this->faker->randomElement($shippingMethods);

        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();
        Assert::notNull($shippingMethod, $this->generateInvalidSkipMessage('shipping', $channel->getCode()));

        foreach ($order->getShipments() as $shipment) {
            $shipment->setMethod($shippingMethod);
            $shipment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_SELECT_SHIPPING);
    }

    protected function selectPayment(OrderInterface $order, \DateTimeInterface $createdAt): void
    {
        if (OrderCheckoutStates::STATE_PAYMENT_SKIPPED === $order->getCheckoutState()) {
            return;
        }

        $paymentMethod = $this
            ->faker
            ->randomElement($this->paymentMethodRepository->findEnabledForChannel($order->getChannel()))
        ;

        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();
        Assert::notNull($paymentMethod, $this->generateInvalidSkipMessage('payment', $channel->getCode()));

        foreach ($order->getPayments() as $payment) {
            $payment->setMethod($paymentMethod);
            $payment->setCreatedAt($createdAt);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_SELECT_PAYMENT);
    }

    protected function completeCheckout(OrderInterface $order): void
    {
        if ($this->faker->boolean(25)) {
            $order->setNotes($this->faker->sentence);
        }

        $this->applyCheckoutStateTransition($order, OrderCheckoutTransitions::TRANSITION_COMPLETE);
    }

    protected function applyCheckoutStateTransition(OrderInterface $order, string $transition): void
    {
        $this->stateMachineFactory->get($order, OrderCheckoutTransitions::GRAPH)->apply($transition);
    }

    protected function generateInvalidSkipMessage(string $type, string $channelCode): string
    {
        return sprintf(
            "No enabled %s method was found for the channel '%s'. ".
            "Set 'skipping_%s_step_allowed' option to true for this channel if you want to skip %s method selection.",
            $type,
            $channelCode,
            $type,
            $type,
        );
    }

    protected function setOrderCompletedDate(OrderInterface $order, \DateTimeInterface $date): void
    {
        if (OrderCheckoutStates::STATE_COMPLETED === $order->getCheckoutState()) {
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
            $stateMachine = $this->stateMachineFactory->get($payment, PaymentTransitions::GRAPH);
            if ($stateMachine->can(PaymentTransitions::TRANSITION_COMPLETE)) {
                $stateMachine->apply(PaymentTransitions::TRANSITION_COMPLETE);
            }
        }
    }

    protected function completeShipments(OrderInterface $order): void
    {
        foreach ($order->getShipments() as $shipment) {
            $stateMachine = $this->stateMachineFactory->get($shipment, ShipmentTransitions::GRAPH);
            if ($stateMachine->can(ShipmentTransitions::TRANSITION_SHIP)) {
                $stateMachine->apply(ShipmentTransitions::TRANSITION_SHIP);
            }
        }
    }
}
