<?php

namespace App\EventListener\Order;

use Webmozart\Assert\Assert;

final class OrderLocaleAssigner
{
    public function __construct(private LocaleContextInterface $localeContext)
    {
    }

    public function assignLocale(ResourceControllerEvent $event): void
    {
        $order = $event->getSubject();

        /** @var OrderInterface $order */
        Assert::isInstanceOf($order, OrderInterface::class);

        $order->setLocaleCode($this->localeContext->getLocaleCode());
    }
}