<?php


	namespace App\EventSubscriber;

	use App\Entity\Order\OrderStorage;
    use App\Event\Events;
    use App\Event\OrderSubmitEvent;
    use JetBrains\PhpStorm\ArrayShape;
    use JetBrains\PhpStorm\NoReturn;
    use JetBrains\PhpStorm\Pure;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\EventDispatcher\GenericEvent;
    use Symfony\Component\Form\FormFactoryInterface;
    use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
    use Symfony\Component\Mailer\MailerInterface;

	class OrderSubscriber implements EventSubscriberInterface
	{
        #[NoReturn]
		public function __construct(private readonly MailerInterface $mailer, private readonly ParameterBagInterface $params, private readonly FormFactoryInterface $formFactory)
		{
		}

		#[ArrayShape([OrderSubmitEvent::NAME => "string"])]
        public static function getSubscribedEvents(): array
		{
			return [
				OrderSubmitEvent::NAME => 'onOrdersOrder',
//                Events::ORDER_BEFORE_CREATE => 'onOrderBeforeCreate', //onPrePersist
//                Events::ORDER_CREATED => 'onOrderCreated', //onPostPersist
//                Events::ORDER_STATUS_UPDATED => 'onOrderStatusUpdated' // onUpdate
            ];
		}
        //TODO: проработать нейминг методов
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


        public function onOrdersOrder(OrderSubmitEvent $orderSubmittedEvent): void
		{
//			$this->mailer->send((array)$orderSubmittedEvent->getOrderSubmited()); //TODO: доработать мейл-нотификацию
		}
	}