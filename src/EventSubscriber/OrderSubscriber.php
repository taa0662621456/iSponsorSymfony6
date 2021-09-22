<?php
declare(strict_types=1);

	namespace App\EventSubscriber;

	use App\Event\OrderSubmitedEvent;
    use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Mailer\MailerInterface;
    use Twig\Error\Error;

	class OrderSubscriber
		implements EventSubscriberInterface
	{
        private MailerInterface $mailer;

        /**
         * @param MailerInterface $mailer
         */
		public function __construct(MailerInterface $mailer)
		{
			$this->mailer = $mailer;
		}

		/**
		 * @return array
		 */
		#[ArrayShape([OrderSubmitedEvent::NAME => "string"])] public static function getSubscribedEvents(): array
		{
			return array(
				OrderSubmitedEvent::NAME => 'onOrdersOrder'
			);
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