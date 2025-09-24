<?php

namespace App\Repository\Menu;

use App\Entity\Menu\MenuItem;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Menu\MenuItemRepositoryInterface;

/**
 * @method MenuItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuItem[]    findAll()
 * @method MenuItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuItemRepository extends EntityRepository implements MenuItemRepositoryInterface
{
}