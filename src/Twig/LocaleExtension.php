<?php

	namespace App\Twig;

	use Symfony\Component\Intl\Locales;
	use Twig\Extension\AbstractExtension;
	use Twig\TwigFunction;

	class LocaleExtension extends AbstractExtension
	{
        /**
         * @var array
         */
        private array $localeCode;

        public function __construct(string $locales)
		{

			$localeCode = explode('|', $locales);
			sort($localeCode);
			$this->localeCode[] = $localeCode;
		}

		/**
		 * {@inheritdoc}
		 */
		public function getFunctions(): array
		{
			return [
				new TwigFunction('locales', [$this, 'getLocales']),
			];
		}

		public function getLocales(): array
		{

            $locales = [];

            if (!empty($this->localeCode)) {
                foreach ($this->localeCode as $locale) {
                    $locales[] = [
                        'code' => $locale,
                        'name' => Locales::getName((string)$locale, (string)$locale)
                    ];
                }
            }
			return $locales ?? [];
		}
	}