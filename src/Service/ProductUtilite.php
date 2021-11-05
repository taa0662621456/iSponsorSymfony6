<?php
declare(strict_types=1);

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ProductUtilite
{
    /**
     * @var EntityManager $em
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * return sorting name param from request
     *
     * @param Request $request
     * @return string
     */
    public function getSortingParamName(Request $request): string
    {
        $sortedBy = '';
        $sortParam = $request->get('sort');

        switch ($sortParam) {
            case 'p.name':
                $sortedBy = 'manufacturer.sort.name';
                break;
            case 'p.price':
                $sortedBy = 'manufacturer.sort.price';
                break;
            default:
                $sortedBy = 'manufacturer.sort.default';
                break;
        }
        return $sortedBy;
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
                return $productLspArray;
            }
        }
        return false;
    }

}
