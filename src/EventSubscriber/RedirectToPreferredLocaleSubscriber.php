<?php


	namespace App\EventSubscriber;


	use JetBrains\PhpStorm\ArrayShape;
	use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpKernel\Event\RequestEvent;
	use Symfony\Component\HttpKernel\KernelEvents;
	use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
    use UnexpectedValueException;
    use function in_array;

    class RedirectToPreferredLocaleSubscriber

	{
		public function __construct(private readonly UrlGeneratorInterface $urlGenerator, private readonly string $locales, private string $locale)
		{
			$locales = explode('|', trim($locales));
			if (empty($locales)) {
				throw new UnexpectedValueException('The list of supported locales must not be empty. Хотя бы одна локаль должна быть в массиве локалей');
			}

			$this->locale = trim($locale) ?? trim($locales[0]);

			if (!in_array($this->locale, $locales, true)) {
				throw new UnexpectedValueException(
					sprintf('The default locale ("%s") must be one of "%s".', $this->locale, $locales)
				);
			}

			// Add the default locale at the first position of the array,
			// because Symfony\HttpFoundation\Request::getPreferredLanguage
			// returns the first element when no an appropriate language is found
//			array_unshift($locales, $this->locale);
//			$this->locales = array_unique($locales);
		}

		#[ArrayShape([KernelEvents::REQUEST => "string"])]
        public static function getSubscribedEvents(): array
		{
			return [
				KernelEvents::REQUEST => 'onKernelRequest',
			];
		}

		public function onKernelRequest(RequestEvent $event): void
		{
			$request = $event->getRequest();

			// Ignore sub-requests and all URLs but the homepage
			if (!$event->isMainRequest() || '/' !== $request->getPathInfo()) {
				return;
			}
			// Ignore requests from referrers with the same HTTP host in order to prevent
			// changing language for users who possibly already selected it for this application.
			if (0 === mb_stripos($request->headers->get('referer'), $request->getSchemeAndHttpHost())) {
				return;
			}

			$preferredLanguage = $request->getPreferredLanguage('');

			if ($preferredLanguage !== $this->locale) {
				$response = new RedirectResponse(
					$this->urlGenerator->generate('homepage', ['_locale' => $preferredLanguage])
				);
				$event->setResponse($response);
			}
		}
	}
