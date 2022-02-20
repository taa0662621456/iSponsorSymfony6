<?php


	namespace App\EventSubscriber;

	use App\Entity\Order\Orders;
    use App\Event\Events;
    use App\Event\OrderSubmitEvent;
    use JetBrains\PhpStorm\ArrayShape;
    use JetBrains\PhpStorm\NoReturn;
    use JetBrains\PhpStorm\Pure;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\EventDispatcher\GenericEvent;
    use Symfony\Component\Form\FormFactoryInterface;
    use Symfony\Component\Mailer\MailerInterface;

	class OrderSubscriber implements EventSubscriberInterface
	{
        #[NoReturn]
		public function __construct(private MailerInterface $mailer, private ParameterBagInterface $params, private FormFactoryInterface $formFactory)
		{
		}

		#[ArrayShape([OrderSubmitEvent::NAME => "string"])]
        public static function getSubscribedEvents(): array
		{
			return array(
				OrderSubmitEvent::NAME => 'onOrdersOrder',
                Events::ORDER_BEFORE_CREATE => 'onOrderBeforeCreate', //onPrePersist
                Events::ORDER_CREATED => 'onOrderCreated', //onPostPersist
                Events::ORDER_STATUS_UPDATED => 'onOrderStatusUpdated' // onUpdate
			);
		}
        //TODO: проработать нейминг методов
        #[Pure]
        public function onOrderBeforeCreate(GenericEvent $event)
        {
            /** @var Orders $order */
            $order = $event->getSubject();
        }

        #[Pure]
        public function onOrderCreated(GenericEvent $event)
        {
            /** @var Orders $order */
            $order = $event->getSubject();
        }

        #[Pure]
        public function onOrderStatusUpdated(GenericEvent $event)
        {
            /** @var Orders $order */
            $order = $event->getSubject();
        }

		public function onOrdersOrder(OrderSubmitEvent $orderSubmittedEvent): void
		{
			$this->mailer->sendNewOrderNotification((array)$orderSubmittedEvent->getOrderSubmited());
		}
	}
