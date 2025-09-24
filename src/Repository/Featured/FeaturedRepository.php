<?php

namespace App\Repository\Featured;

use App\Entity\Featured\Featured;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Featured\FeaturedRepositoryInterface;

/**
 * @method Featured|null find($id, $lockMode = null, $lockVersion = null)
 * @method Featured|null findOneBy(array $criteria, array $orderBy = null)
 * @method Featured[]    findAll()
 * @method Featured[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeaturedRepository extends EntityRepository implements FeaturedRepositoryInterface
{
}