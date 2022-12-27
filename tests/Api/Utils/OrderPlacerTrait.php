<?php


namespace Utils;



use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

trait OrderPlacerTrait
{
    protected function placeOrder(string $tokenValue, string $email = 'example@example.com'): void
    {
        /** @var MessageBusInterface $commandBus */
        $commandBus = self::getContainer()->get('command_bus');

        $pickupCartCommand = new PickupCart($tokenValue, 'en_US');
        $pickupCartCommand->setChannelCode('WEB');
        $commandBus->dispatch($pickupCartCommand);

        $addItemToCartCommand = new AddItemToCart('MUG_BLUE', 3);
        $addItemToCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($addItemToCartCommand);

        $address = new Address();
        $address->setFirstName('John');
        $address->setLastName('Doe');
        $address->setCity('New York');
        $address->setStreet('Avenue');
        $address->setCountryCode('US');
        $address->setPostcode('90000');

        $updateCartCommand = new UpdateCart($email, $address);
        $updateCartCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($updateCartCommand);

        /** @var OrderRepositoryInterface $orderRepository */
        $orderRepository = $this->get('repository.order');
        /** @var OrderInterface|null $cart */
        $cart = $orderRepository->findCartByTokenValue($tokenValue);
        Assert::notNull($cart);

        $chooseShippingMethodCommand = new ChooseShippingMethod('UPS');
        $chooseShippingMethodCommand->setOrderTokenValue($tokenValue);
        $chooseShippingMethodCommand->setSubresourceId((string) $cart->getShipments()->first()->getId());
        $commandBus->dispatch($chooseShippingMethodCommand);

        $choosePaymentMethodCommand = new ChoosePaymentMethod('CASH_ON_DELIVERY');
        $choosePaymentMethodCommand->setOrderTokenValue($tokenValue);
        $choosePaymentMethodCommand->setSubresourceId((string) $cart->getLastPayment()->getId());
        $commandBus->dispatch($choosePaymentMethodCommand);

        $completeOrderCommand = new CompleteOrder();
        $completeOrderCommand->setOrderTokenValue($tokenValue);
        $commandBus->dispatch($completeOrderCommand);
    }
}
