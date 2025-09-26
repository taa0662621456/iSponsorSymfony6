<?php

namespace App\Service;

use App\DTO\CartPricing;
use App\DTO\CartSnapshot;

interface CheckoutServiceInterface
{
    public function getCart(): CartSnapshot;
    public function start(?string $idempotencyKey, CartPricing $snapshot): void;
    public function setShipping(array $address, string $methodCode): void;
    public function setPayment(string $methodCode): void;

}
