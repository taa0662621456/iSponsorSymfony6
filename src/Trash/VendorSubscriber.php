<?php
declare(strict_types=1);

	namespace App\EventSubscriber;

    use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\Mailer\Mailer;
    use Symfony\Component\Mailer\MailerInterface;
    use Twig\Error\Error;
	use Twig\Error\LoaderError;
	use Twig\Error\RuntimeError;
	use Twig\Error\SyntaxError;

	class VendorSubscriber implements EventSubscriberInterface
	{
		/**
		 * @var Mailer
		 */
		private $mailer;

		/**
		 * @param Mailer $mailer
		 */
		public function __construct(MailerInterface $mailer)
		{
			$this->mailer = $mailer;
		}

		/**
		 * @return array
		 */
		#[ArrayShape([\App\Event\RegisteredEvent::NAME => "string"])] public static function getSubscribedEvents(): array
		{
			return array(
				RegisteredEvent::NAME => 'onVendorsRegistration'
			);
		}

		/**
		 * @param RegisteredEvent $vendorRegisteredEvent
		 *
		 * @throws LoaderError
		 * @throws RuntimeError
		 * @throws SyntaxError
		 * @throws Error
		 */
		public function onVendorsRegistration(RegisteredEvent $vendorRegisteredEvent): void
		{
			$this->mailer->sendConfirmationMessage($vendorRegisteredEvent->getVendorRegistered());
		}
	}