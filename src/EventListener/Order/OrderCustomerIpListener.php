<?php

namespace App\EventListener\Order;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Webmozart\Assert\Assert;

final class OrderCustomerIpListener
{
    public function __construct(private IpAssignerInterface $ipAssigner, private RequestStack $requestStack)
    {
    }

    public function assignCustomerIpToOrder(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, OrderInterface::class);

        $this->ipAssigner->assign($subject, $this->requestStack->getMainRequest());
    }
}