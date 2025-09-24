<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use function is_bool;

class ProductUtilite
{
    /**
     * return sorting name param from request.
     */
    public function getSortingParamName(Request $request): string
    {
        $sortParam = $request->get('sort');

        return match ($sortParam) {
            'p.name' => 'manufacturer.sort.name',
            'p.price' => 'manufacturer.sort.price',
            default => 'manufacturer.sort.default',
        };
    }

    /**
     * return last seen products from cookies.
     */
    public function getLastSeenProducts(Request $request): bool
    {
        $cookies = $request->cookies->all();

        if (isset($cookies['last-seen'])) {
            $productLspArray = json_decode($cookies['last-seen'], true);

            if (is_bool($productLspArray) && !empty($productLspArray)) {
                return true;
            }
        }

        return false;
    }
}