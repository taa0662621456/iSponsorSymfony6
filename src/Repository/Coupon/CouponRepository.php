<?php

namespace App\Repository\Coupon;

use App\Entity\Commission\Commission;
use App\Entity\Coupon\Coupon;
use App\RepositoryInterface\Coupon\CouponRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coupon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupon[]    findAll()
 * @method Coupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponRepository extends EntityRepository implements CouponRepositoryInterface
{

}
