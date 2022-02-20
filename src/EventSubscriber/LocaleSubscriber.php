<?php


	namespace App\EventSubscriber;

	use JetBrains\PhpStorm\ArrayShape;
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\HttpKernel\Event\RequestEvent;
    use Symfony\Component\HttpKernel\KernelEvents;


    class LocaleSubscriber implements EventSubscriberInterface
    {
        public function __construct(private string $locale = 'en')
								{
								}

        public function onKernelRequest(RequestEvent $event)
        {
            $request = $event->getRequest();
            if (!$request->hasPreviousSession()) {
                return;
            }

            if ($locale = $request->attributes->get('_locale')) {
                $request->getSession()->set('_locale', $locale);
            } else {
                $request->setLocale($request->getSession()->get('_locale', $this->locale));
            }
        }

        #[ArrayShape([KernelEvents::REQUEST => "array[]"])] public static function getSubscribedEvents(): array
        {
            return array(
                KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
            );
        }
    }
