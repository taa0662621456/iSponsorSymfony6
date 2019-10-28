<?php
declare(strict_types=1);

	namespace App\EventSubscriber;

	use App\Event\OrderSubmitedEvent;
	use App\Service\Mailer;
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Twig\Error\Error;

	class OrderSubscriber
		implements EventSubscriberInterface
	{
		/**
		 * @var Mailer
		 */
		private $mailer;

		/**
		 * @param Mailer $mailer
		 */
		public function __construct(Mailer $mailer)
		{
			$this->mailer = $mailer;
		}

		/**
		 * @return array
		 */
		public static function getSubscribedEvents(): array
		{
			return array(
				OrderSubmitedEvent::NAME => 'onOrdersOrder'
			);
		}

		/**
		 * @param OrderSubmitedEvent $orderSubmitedEvent
		 *
		 * @throws Error
		 */
		public function onOrdersOrder(OrderSubmitedEvent $orderSubmitedEvent): void
		{
			$this->mailer->sendNewOrderNotification((array)$orderSubmitedEvent->getOrderSubmited());
		}
	}