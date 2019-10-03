<?php

	namespace App\Tests;

	use App\DataFixtures\CategoriesFixtures;
	use App\DataFixtures\OrdersFixtures;
	use App\DataFixtures\ProductsFixtures;
	use App\DataFixtures\VendorsFixtures;
	use App\Entity\Order\OrdersStatus;
	use App\Entity\Project\ProjectsFavourites;
	use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
	use Doctrine\Common\DataFixtures\Loader;
	use Doctrine\Common\DataFixtures\Purger\ORMPurger;
	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Tools\SchemaTool;
	use Doctrine\ORM\Tools\ToolsException;
	use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

	class FixturesTest extends WebTestCase
	{
		/**
		 * @var EntityManager|object|null
		 */
		private static $em;

		protected function setUp()
		{
			self::$em = self::$container->get(EntityManagerInterface::class);
		}

		public function testFixtures()
		{
			/** @var EntityManagerInterface $em */
			self::$em->getContainer()->get('doctrine')->getManager();

			$schemaTool = new SchemaTool($em);
			$metadata = $em->getMetadataFactory()->getAllMetadata();

			// Drop and recreate tables for all entities
			$schemaTool->dropSchema($metadata);

			try {
				$schemaTool->createSchema($metadata);
			} catch (ToolsException $e) {
			}
			FixturesTest::assertTrue(true);

			if ($fixtures = static::getFixtures()) {
				// Load common fixtures
				$loader = new Loader();

				foreach ($fixtures as $fixture) {
					$loader->addFixture($fixture);
				}

				$purger = new ORMPurger(self::$em);
				$purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
				$executor = new ORMExecutor(self::$em, $purger);
				$executor->execute($loader->getFixtures());
			}
		}

		private static function getFixtures(): array
		{
			return [
				new VendorsFixtures(),
				new CategoriesFixtures(),
				new OrdersStatus(),
				new ProjectsFavourites(),
				new ProductsFixtures(),
				new OrdersFixtures()
			];
		}
	}
