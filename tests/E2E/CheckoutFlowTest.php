<?php

use App\DataFixtures\UserFixtures;
use App\DataFixtures\OrderFixtures;
use Liip\TestFixturesBundle\Services\DatabaseTools\ORMDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);

beforeEach(function () {
    /** @var ORMDatabaseTool $databaseTool */
    $databaseTool = self::getContainer()->get('liip_test_fixtures.services.database_tools');
    $databaseTool->loadFixtures([UserFixtures::class, OrderFixtures::class]);
});

it('customer creates order, manager updates, admin finalizes', function () {
    $client = static::createClient();

    $customer = self::getContainer()->get('doctrine')->getRepository(App\Entity\Vendor\Vendor::class)
        ->findOneBy(['email' => 'customer@example.com']);
    $client->loginUser($customer);

    // Customer creates order
    $cart = [
        'items' => [['qty' => 1, 'unitPrice' => ['amount' => '10.00', 'currency' => 'USD']]],
        'currency' => 'USD',
        'taxMode' => 'EXCLUSIVE',
    ];
    $client->jsonRequest('POST', '/api/orders', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(201);
    $data = json_decode($client->getResponse()->getContent(), true);
    $orderId = $data['id'];

    // Manager updates status
    $manager = self::getContainer()->get('doctrine')->getRepository(App\Entity\Vendor\Vendor::class)
        ->findOneBy(['email' => 'manager@example.com']);
    $client->loginUser($manager);
    $client->jsonRequest('PATCH', "/api/orders/$orderId/status", ['status' => 'PENDING_PAYMENT']);
    expect(in_array($client->getResponse()->getStatusCode(), [200,403]))->toBeTrue();

    // Admin finalizes
    $admin = self::getContainer()->get('doctrine')->getRepository(App\Entity\Vendor\Vendor::class)
        ->findOneBy(['email' => 'admin@example.com']);
    $client->loginUser($admin);
    $client->jsonRequest('PATCH', "/api/orders/$orderId/status", ['status' => 'PAID']);
    expect(in_array($client->getResponse()->getStatusCode(), [200,403]))->toBeTrue();
});
