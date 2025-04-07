<?php

namespace App\EventListener\Listener_Sylius;

use App\EntityInterface\Address\AddressInterface;
use Webmozart\Assert\Assert;

final class CustomerDefaultAddressListener
{
    public function preCreate(ResourceControllerEvent $event): void
    {
        $address = $event->getSubject();

        /* @var AddressInterface $address */
        Assert::isInstanceOf($address, AddressInterface::class);

        $this->setAddressAsDefault($address);
    }

    private function setAddressAsDefault(AddressInterface $address): void
    {
        if (null !== $address->getId()) {
            return;
        }

        /** @var Customer|null $customer */
        $customer = $address->getCustomer();

        if (null !== $customer && null === $customer->getDefaultAddress()) {
            $customer->setDefaultAddress($address);
        }
    }
}
