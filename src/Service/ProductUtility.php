<?php


namespace App\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ProductUtility
{
    /**
     * return sorting name param from request
     *
     * @param Request $request
     * @return string
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
     * return last seen products from cookies
     *
     * @param Request $request
     * @return bool
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
