<?php

namespace App\Event;

final class Events
{
    //TODO: проработать на предмет универсальности (продукт, проект, вендор и другие объекты)
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const PRODUCT_CREATED = 'product.created';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const PRODUCT_UPDATED = 'product.updated';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const PRODUCT_DELETED = 'product.deleted';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const ORDER_BEFORE_CREATE = 'order.before_create';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const ORDER_CREATED = 'order.created';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const ORDER_DELETED = 'order.deleted';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const ORDER_STATUS_UPDATED = 'order.status_updated';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const USER_EMAIL_CONFIRMED = 'user.email_confirmed';
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     * @var string
     */
    public const SHOPPING_CART_ADD_PRODUCT = 'shopping_cart.add_product';
}
