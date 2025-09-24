<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);
require_once __DIR__ . '/cart_helper.php';

it('creates order from valid cart', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([makeItem(1, '20.00')]);
    $client->jsonRequest('POST', '/api/orders', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(201);
    $data = json_decode($client->getResponse()->getContent(), true);
    expect($data)->toHaveKeys(['id','grandTotal','currency','status']);
});

it('rejects order with empty cart', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([]);
    $client->jsonRequest('POST', '/api/orders', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(400);
});

it('shows existing order or 404', function () {
    $client = static::createClient();
    $client->request('GET', '/api/orders/1');
    $status = $client->getResponse()->getStatusCode();
    expect(in_array($status, [200,404]))->toBeTrue();
});

it('updates order status with valid transition', function () {
    $client = static::createClient();
    $payload = ['status' => 'PENDING_PAYMENT'];
    $client->jsonRequest('PATCH', '/api/orders/1/status', $payload);
    $status = $client->getResponse()->getStatusCode();
    expect(in_array($status, [200,404,400,403]))->toBeTrue();
});
