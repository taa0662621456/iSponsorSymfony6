<?php

namespace App\Repository\Coupon;

use App\Entity\Coupon\Coupon;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Coupon\CouponRepositoryInterface;

/**
 * @method Coupon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupon[]    findAll()
 * @method Coupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponRepository extends EntityRepository implements CouponRepositoryInterface
{


    public function add($coupon)
    {
        // TODO: Implement add() method.
    }

    public function createNew()
    {
        // TODO: Implement createNew() method.
    }
}
