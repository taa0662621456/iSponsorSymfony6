<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductAttachment;
use App\RepositoryInterface\Product\ProductAttributeRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method ProductAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttachment[]    findAll()
 * @method ProductAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductProductAttributeRepository extends EntityRepository implements ProductAttributeRepositoryInterface
{

}
