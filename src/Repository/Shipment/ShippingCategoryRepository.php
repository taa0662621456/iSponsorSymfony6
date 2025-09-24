<?php


namespace App\Repository\Shipment;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class ShippingCategoryRepository extends EntityRepository
{
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o');
    }
}