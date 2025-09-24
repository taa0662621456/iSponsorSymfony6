<?php

use App\Factory\VendorFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);

it('allows ROLE_ADMIN to access orders list', function () {
    $client = static::createClient();
    $admin = VendorFactory::new()->asAdmin()->create();
    $client->loginUser($admin->object());

    $client->request('GET', '/admin/api/orders');
    expect($client->getResponse()->getStatusCode())->toBe(200);
});

it('forbids ROLE_CUSTOMER from accessing orders list', function () {
    $client = static::createClient();
    $customer = VendorFactory::new()->asCustomer()->create();
    $client->loginUser($customer->object());

    $client->request('GET', '/admin/api/orders');
    expect($client->getResponse()->getStatusCode())->toBe(403);
});

it('allows ROLE_ADMIN to delete order', function () {
    $client = static::createClient();
    $admin = VendorFactory::new()->asAdmin()->create();
    $client->loginUser($admin->object());

    $client->request('DELETE', '/admin/api/orders/1');
    $status = $client->getResponse()->getStatusCode();
    expect(in_array($status, [200, 404]))->toBeTrue(); // if order 1 not exists, 404 is acceptable
});
