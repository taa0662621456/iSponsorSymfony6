<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class OrderEvent extends Event
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const ORDER_BEFORE_CREATE = 'order.before_create';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const ORDER_CREATED = 'order.created';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const ORDER_DELETED = 'order.deleted';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const ORDER_STATUS_UPDATED = 'order.status_updated';

}
