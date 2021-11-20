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
		    if (0 !== count($this->localeCode)) {
                foreach ($this->localeCode as $locales) {
                    $locales[] = ['code' => $this->localeCode, 'name' => Locales::getName((string)$this->localeCode, (string)$this->localeCode)];
                }
            }
			return $locales ?? [];
		}
	}
