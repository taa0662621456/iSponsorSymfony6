<?php
declare(strict_types=1);

	namespace App\EventSubscriber;

	use App\Entity\Order\Orders;
    use App\Event\Events;
    use App\Event\OrderSubmitedEvent;
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
        private MailerInterface $mailer;
        /**
         * @var ParameterBagInterface
         */
        private ParameterBagInterface $params;
        /**
         * @var FormFactoryInterface
         */
        private FormFactoryInterface $formFactory;

        //TODO: этот класс должен, скорее всего объединиться с классом прослушивания доктрины


        /**
         * @param MailerInterface $mailer
         * @param ParameterBagInterface $params
         * @param FormFactoryInterface $formFactory
         */
		#[NoReturn]
        public function __construct(MailerInterface $mailer, ParameterBagInterface $params,
                                    FormFactoryInterface $formFactory)
		{
			$this->mailer = $mailer;
            $this->params = $params;
            $this->formFactory = $formFactory;
		}

		/**
		 * @return array
		 */
		#[ArrayShape([OrderSubmitedEvent::NAME => "string"])]
        public static function getSubscribedEvents(): array
		{
			return array(
				OrderSubmitedEvent::NAME => 'onOrdersOrder',
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

		/**
		 * @param OrderSubmitedEvent $orderSubmittedEvent
		 *
         */
		public function onOrdersOrder(OrderSubmitedEvent $orderSubmittedEvent): void
		{
			$this->mailer->sendNewOrderNotification((array)$orderSubmittedEvent->getOrderSubmited());
		}
	}