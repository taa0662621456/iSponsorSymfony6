<?php

namespace App\Repository\Category;

use App\Entity\Category\Category;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Category\CategoryRepositoryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
}
