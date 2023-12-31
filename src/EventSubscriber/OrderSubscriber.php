<?php

namespace App\EventSubscriber;

use App\Event\OrderEvent;
use JetBrains\PhpStorm\Pure;
use JetBrains\PhpStorm\NoReturn;
use App\Entity\Order\OrderStorage;
use JetBrains\PhpStorm\ArrayShape;
use App\Event\Order\OrderSubmitEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OrderSubscriber implements EventSubscriberInterface
{
    #[NoReturn]
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly ParameterBagInterface $params,
        private readonly FormFactoryInterface $formFactory
    ) {
    }

    #[ArrayShape([
        OrderSubmitEvent::NAME => 'string',
        OrderEvent::ORDER_BEFORE_CREATE => 'string',
        OrderEvent::ORDER_CREATED => 'string',
        OrderEvent::ORDER_STATUS_UPDATED => 'string',
        ])]
    public static function getSubscribedEvents(): array
    {
        return [
            OrderSubmitEvent::NAME => 'onOrder',
            OrderEvent::ORDER_BEFORE_CREATE => 'onOrderBeforeCreate', // onPrePersist
            OrderEvent::ORDER_CREATED => 'onOrderCreated', // onPostPersist
            OrderEvent::ORDER_STATUS_UPDATED => 'onOrderStatusUpdated', // onUpdate
        ];
    }

    #[Pure]
    public function onOrderBeforeCreate(GenericEvent $event)
    {
        /** @var OrderStorage $order */
        $order = $event->getSubject();
    }

    #[Pure]
    public function onOrderCreated(GenericEvent $event)
    {
        /** @var OrderStorage $order */
        $order = $event->getSubject();
    }

    #[Pure]
    public function onOrderStatusUpdated(GenericEvent $event)
    {
        /** @var OrderStorage $order */
        $order = $event->getSubject();
    }

    public function onOrder(OrderSubmitEvent $orderSubmittedEvent): void
    {
        //			$this->mailer->send((array)$orderSubmittedEvent->getOrderSubmited()); //TODO: доработать мейл-нотификацию
    }
}
