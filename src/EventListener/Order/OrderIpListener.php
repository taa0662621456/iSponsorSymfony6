<?php

namespace App\EventListener\Order;

use Webmozart\Assert\Assert;
use App\Interface\IpAssignerInterface;
use App\Interface\Order\OrderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\GenericEvent;

final class OrderIpListener
{
    public function __construct(
        private readonly IpAssignerInterface $ipAssigner,
        private readonly RequestStack $requestStack
    ) {
    }

    public function assignCustomerIpToOrder(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, OrderInterface::class);

        $this->ipAssigner->assign($subject, $this->requestStack->getMainRequest());
    }
}