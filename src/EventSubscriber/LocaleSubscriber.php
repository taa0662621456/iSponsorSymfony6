<?php
declare(strict_types=1);

	namespace App\EventSubscriber;

	use JetBrains\PhpStorm\ArrayShape;
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\HttpKernel\Event\RequestEvent;
    use Symfony\Component\HttpKernel\KernelEvents;


    class LocaleSubscriber implements EventSubscriberInterface
    {
        private mixed $defaultLocale;

        public function __construct($defaultLocale = 'en')
        {
            $this->defaultLocale = $defaultLocale;
        }

        /**
         * @param RequestEvent $event
         */
        public function onKernelRequest(RequestEvent $event)
        {
            $request = $event->getRequest();
            if (!$request->hasPreviousSession()) {
                return;
            }

            // попробуйте увидеть, была ли локаль установлена как параметр маршрутизации _locale
            if ($locale = $request->attributes->get('_locale')) {
                $request->getSession()->set('_locale', $locale);
            } else {
                // если для этого запроса не было ясно установлено никакой локали, используйте её из сесии
                $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
            }
        }

        #[ArrayShape([KernelEvents::REQUEST => "array[]"])] public static function getSubscribedEvents(): array
        {
            return array(
                // должен быть зарегистрирован после слушателя локали по умолчанию
                KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
            );
        }
    }