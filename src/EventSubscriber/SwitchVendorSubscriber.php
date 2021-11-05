<?php

	namespace App\EventSubscriber;

	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\Security\Http\Event\SwitchUserEvent;
	use Symfony\Component\Security\Http\SecurityEvents;

	class SwitchVendorSubscriber
		implements EventSubscriberInterface
	{
		public function onSwitchVendor(SwitchUserEvent $event)
		{
			$request = $event->getRequest();

			if ($request->hasSession() && ($session = $request->getSession())) {
				$session->set(
					'_locale',
					// assuming your User has some getLocale() method
					$event->getTargetUser()->getLocale()
				);
			}
		}

		public static function getSubscribedEvents()
		{
			return [
				// constant for security.switch_user
				SecurityEvents::SWITCH_USER => 'onSwitchVendor',
			];
		}
	}
