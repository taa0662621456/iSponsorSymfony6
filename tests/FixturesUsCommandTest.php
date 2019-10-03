<?php

	namespace App\Tests;

	use Exception;
	use Symfony\Bundle\FrameworkBundle\Console\Application;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
	use Symfony\Component\Console\Input\StringInput;

	class FixturesUsCommandTest extends WebTestCase
	{
		protected static $application;

		protected function setUp()
		{

			//self::runCommand('doctrine:database:create');
			//self::testFixtures('doctrine:schema:update --force');
			//self::testFixtures('doctrine:fixtures:load --append');
		}

		public static function testFixtures($command)
		{
			$command = sprintf('%s --quiet', $command);

			try {
				return self::getApplication()->run(new StringInput($command));
			} catch (Exception $e) {
			}
		}

		protected static function getApplication()
		{
			if (null === self::$application) {
				$client = static::createClient();

				self::$application = new Application($client->getKernel());
				self::$application->setAutoExit(false);
			}

			return self::$application;
		}
	}
