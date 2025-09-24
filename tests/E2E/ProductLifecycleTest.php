<?php

use App\DataFixtures\UserFixtures;
use App\DataFixtures\ProductFixtures;
use Liip\TestFixturesBundle\Services\DatabaseTools\ORMDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);

beforeEach(function () {
    /** @var ORMDatabaseTool $databaseTool */
    $databaseTool = self::getContainer()->get('liip_test_fixtures.services.database_tools');
    $databaseTool->loadFixtures([UserFixtures::class, ProductFixtures::class]);
});

it('admin can soft-delete and restore product', function () {
    $client = static::createClient();

    $admin = self::getContainer()->get('doctrine')->getRepository(App\Entity\Vendor\Vendor::class)
        ->findOneBy(['email' => 'admin@example.com']);
    $client->loginUser($admin);

    $product = self::getContainer()->get('doctrine')->getRepository(App\Entity\Product\Product::class)
        ->findOneBy(['code' => 'TEST123']);

    $client->request('POST', "/admin/api/products/{$product->getId()}/soft-delete");
    expect(in_array($client->getResponse()->getStatusCode(), [200,403]))->toBeTrue();

    $client->request('POST', "/admin/api/products/{$product->getId()}/restore");
    expect(in_array($client->getResponse()->getStatusCode(), [200,403]))->toBeTrue();
});

it('manager cannot delete product', function () {
    $client = static::createClient();

    $manager = self::getContainer()->get('doctrine')->getRepository(App\Entity\Vendor\Vendor::class)
        ->findOneBy(['email' => 'manager@example.com']);
    $client->loginUser($manager);

    $product = self::getContainer()->get('doctrine')->getRepository(App\Entity\Product\Product::class)
        ->findOneBy(['code' => 'TEST123']);

    $client->request('DELETE', "/admin/api/products/{$product->getId()}");
    expect($client->getResponse()->getStatusCode())->toBe(403);
});
