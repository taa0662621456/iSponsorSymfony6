<?php
namespace App\Tests\Command;

use App\Entity\Category\Category;
use App\Entity\Coupon\Coupon;
use App\Entity\Order\OrderStorage;
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

class FixturesLoadGroupCommandTest extends KernelTestCase
{
    /**
     * @dataProvider groupProvider
     */
    public function testLoadGroup(string $group, string $entityClass, bool $shouldExist): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $command = self::$kernel->getContainer()->get(\App\Command\FixturesLoadGroupCommand::class);
        $application->add($command);

        $commandTester = new CommandTester($application->find('fixtures:load-group'));
        $commandTester->execute([
            'group' => $group,
            '--append' => true,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString("Fixtures for group '{$group}' loaded successfully", $output);

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $entities = $em->getRepository($entityClass)->findAll();

        if ($shouldExist) {
            $this->assertNotEmpty($entities, "Expected entities for group {$group}, but none found");
        } else {
            $this->assertEmpty($entities, "Expected no entities for group {$group}, but some were found");
        }
    }

    public static function groupProvider(): array
    {
        return [
            ['core',    Vendor::class,    true],
            ['catalog', Product::class, true],
            ['promo',   Coupon::class,  true],
            ['order',   OrderStorage::class,   true],
        ];
    }

    public function testCatalogFixturesPriority(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $command = self::$kernel->getContainer()->get(\App\Command\FixturesLoadGroupCommand::class);
        $application->add($command);

        $commandTester = new CommandTester($application->find('fixtures:load-group'));
        $commandTester->execute([
            'group' => 'catalog',
            '--append' => true,
        ]);

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();

        $categories = $em->getRepository(Category::class)->findAll();
        $products   = $em->getRepository(Product::class)->findAll();
        $vendors    = $em->getRepository(Vendor::class)->findAll();

        $this->assertNotEmpty($categories, "Categories should be created first");
        $this->assertNotEmpty($products, "Products should exist after categories");
        $this->assertNotEmpty($vendors, "Vendors should exist last");

        foreach ($products as $product) {
            $this->assertNotNull($product->getCategory(), "Product must be linked to a Category");
        }
    }

    public function testOrderFixturesDependencies(): void
    {
        self::bootKernel();

        $application = new Application(self::$kernel);
        $command = self::$kernel->getContainer()->get(\App\Command\FixturesLoadGroupCommand::class);
        $application->add($command);

        $commandTester = new CommandTester($application->find('fixtures:load-group'));
        $commandTester->execute([
            'group' => 'order',
            '--append' => true,
        ]);

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $orders = $em->getRepository(OrderStorage::class)->findAll();

        $this->assertNotEmpty($orders, "Orders should be created");

        foreach ($orders as $order) {
            $this->assertNotNull($order->getUser(), "Order must be linked to a User");
            $this->assertNotEmpty($order->getProducts(), "Order must have at least one Product");
        }
    }
}
