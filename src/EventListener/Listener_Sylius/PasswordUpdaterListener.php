<?php

namespace App\EventListener\Listener_Sylius;

use App\EntityInterface\Customer\CustomerInterface;
use InvalidArgumentException;
use Webmozart\Assert\Assert;
use Symfony\Component\EventDispatcher\GenericEvent;

final class PasswordUpdaterListener extends BasePasswordUpdaterListener
{
    /**
     * @throws InvalidArgumentException
     */
    public function customerUpdateEvent(GenericEvent $event): void
    {
        $customer = $event->getSubject();

        /* @var CustomerInterface $customer */
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        if (null !== $user) {
            $this->updatePassword($user);
        }
    }
}
