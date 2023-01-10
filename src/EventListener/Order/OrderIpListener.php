<?php

namespace App\EventListener\Order;

use App\Interface\IpAssignerInterface;
use App\Interface\Order\OrderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Webmozart\Assert\Assert;

final class OrderIpListener
{
    public function __construct(private readonly IpAssignerInterface $ipAssigner,
                                private readonly RequestStack $requestStack)
    {
    }

    public function assignCustomerIpToOrder(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, OrderInterface::class);

        $this->ipAssigner->assign($subject, $this->requestStack->getMainRequest());
    }
}
