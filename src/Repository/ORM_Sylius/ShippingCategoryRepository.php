<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;


class ShippingCategoryRepository extends EntityRepository implements ShippingCategoryRepositoryInterface
{
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o');
    }
}
