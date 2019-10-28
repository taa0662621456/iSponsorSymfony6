<?php
	declare(strict_types=1);

	namespace App\EventSubscriber;

	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
	use Symfony\Component\Security\Http\SecurityEvents;

	class LocaleSubscriber
		implements EventSubscriberInterface
	{
		private $session;

		public function __construct(SessionInterface $session)
		{
			$this->session = $session;
		}

		public function onInteractiveLogin(InteractiveLoginEvent $event)
		{
			$user = $event->getAuthenticationToken()->getUser();

			if (null !== $user->getLocale()) {
				$this->session->set('_locale', $user->getLocale());
			}
		}

		public static function getSubscribedEvents()
		{
			return [
				SecurityEvents::INTERACTIVE_LOGIN => 'onInteractiveLogin',
			];
		}
	}