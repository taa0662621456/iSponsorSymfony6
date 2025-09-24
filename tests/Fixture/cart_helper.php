<?php

function makeCartSnapshot(array $items, string $currency = 'USD', string $taxMode = 'EXCLUSIVE'): array {
    return [
        'items' => $items,
        'currency' => $currency,
        'taxMode' => $taxMode,
    ];
}

function makeItem(int $qty, string $unitPrice, ?string $discount = null, string $currency = 'USD'): array {
    $item = [
        'qty' => $qty,
        'unitPrice' => [
            'amount' => $unitPrice,
            'currency' => $currency,
        ],
    ];
    if ($discount) {
        $item['unitDiscount'] = [
            'amount' => $discount,
            'currency' => $currency,
        ];
    }
    return $item;
}
