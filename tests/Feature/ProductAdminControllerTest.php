<?php

use App\Factory\VendorFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);

it('allows ROLE_ADMIN to delete product', function () {
    $client = static::createClient();
    $admin = VendorFactory::new()->asAdmin()->create();
    $client->loginUser($admin->object());

    $client->request('DELETE', '/admin/api/products/1');
    $status = $client->getResponse()->getStatusCode();
    expect(in_array($status, [200, 404]))->toBeTrue();
});

it('forbids ROLE_MANAGER to delete product', function () {
    $client = static::createClient();
    $manager = VendorFactory::new()->asManager()->create();
    $client->loginUser($manager->object());

    $client->request('DELETE', '/admin/api/products/1');
    expect($client->getResponse()->getStatusCode())->toBe(403);
});

it('forbids ROLE_CUSTOMER to delete product', function () {
    $client = static::createClient();
    $customer = VendorFactory::new()->asCustomer()->create();
    $client->loginUser($customer->object());

    $client->request('DELETE', '/admin/api/products/1');
    expect($client->getResponse()->getStatusCode())->toBe(403);
});
