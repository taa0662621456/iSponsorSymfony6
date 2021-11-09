<?php

	namespace App\EventSubscriber;

	use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\HttpKernel\Event\RequestEvent;
	use Symfony\Component\HttpKernel\KernelEvents;
	use Symfony\Component\Security\Http\Util\TargetPathTrait;

	class RedirectingToTheLastAccessedPageSubscriber
		implements EventSubscriberInterface
	{
		use TargetPathTrait;

		private SessionInterface $session;

		public function __construct(SessionInterface $session)
		{
			$this->session = $session;
		}

		public function onKernelRequest(RequestEvent $event): void
		{
			$request = $event->getRequest();
			if (!$event->isMainRequest() || $request->isXmlHttpRequest()) {
				return;
			}

			$this->saveTargetPath($this->session, 'main', $request->getUri());
		}

		#[ArrayShape([KernelEvents::REQUEST => "string[]"])]
        public static function getSubscribedEvents(): array
        {
			return [
				KernelEvents::REQUEST => ['onKernelRequest']
			];
		}
	}
