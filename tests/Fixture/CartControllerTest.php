<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

uses(WebTestCase::class);
require_once __DIR__ . '/cart_helper.php';

it('prices a valid cart', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([makeItem(2, '10.00')]);
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    $response = $client->getResponse();
    expect($response->getStatusCode())->toBe(200);
    $data = json_decode($response->getContent(), true);
    expect($data)->toHaveKeys(['itemsSubtotal','grandTotal','currency']);
    expect($data['itemsSubtotal'])->toBe('20.00');
});

it('applies discount correctly', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([makeItem(1, '10.00', '2.00')]);
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    $data = json_decode($client->getResponse()->getContent(), true);
    expect($data['discountTotal'])->toBe('2.00');
    expect($data['grandTotal'])->toBe('8.00');
});

it('applies tax correctly', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([makeItem(1, '100.00')], 'USD', 'EXCLUSIVE');
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    $data = json_decode($client->getResponse()->getContent(), true);
    expect($data['taxTotal'])->not->toBeNull();
});

it('rejects empty cart', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([]);
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(400);
});

it('rejects qty < 1', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([makeItem(0, '10.00')]);
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(400);
});

it('rejects mixed currencies', function () {
    $client = static::createClient();
    $cart = makeCartSnapshot([
        makeItem(1, '10.00', null, 'USD'),
        makeItem(1, '5.00', null, 'EUR')
    ]);
    $client->jsonRequest('POST', '/api/cart/price', $cart);
    expect($client->getResponse()->getStatusCode())->toBe(400);
});
