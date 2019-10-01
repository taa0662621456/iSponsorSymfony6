<?php

	/*
	 * This file is part of the Symfony package.
	 *
	 * (c) Fabien Potencier <fabien@symfony.com>
	 *
	 * For the full copyright and license information, please view the LICENSE
	 * file that was distributed with this source code.
	 */

	namespace App\Twig;

	use Symfony\Component\Intl\Locales;
	use Twig\Extension\AbstractExtension;
	use Twig\TwigFunction;

	/**
	 * This Twig extension adds a new 'md2html' filter to easily transform Markdown
	 * contents into HTML contents inside Twig templates.
	 *
	 * See https://symfony.com/doc/current/templating/twig_extension.html
	 *
	 * @author Ryan Weaver <weaverryan@gmail.com>
	 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
	 * @author Julien ITARD <julienitard@gmail.com>
	 */
	class AppExtension extends AbstractExtension
	{
		private $localeCodes;
		private $locales;

		public function __construct(string $locales)
		{

			$localeCodes = explode('|', $locales);
			sort($localeCodes);
			$this->localeCodes = $localeCodes;
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

		/**
		 * Takes the list of codes of the locales (languages) enabled in the
		 * application and returns an array with the name of each locale written
		 * in its own language (e.g. English, Français, Español, etc.).
		 */
		public function getLocales(): array
		{
			if (null !== $this->locales) {
				return $this->locales;
			}

			$this->locales = [];
			foreach ($this->localeCodes as $localeCode) {
				$this->locales[] = ['code' => $localeCode, 'name' => Locales::getName($localeCode, $localeCode)];
			}

			return $this->locales;
		}
	}
