<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductShipment;
use Doctrine\ORM\EntityRepository;

/**
 * @method ProductShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductShipment[]    findAll()
 * @method ProductShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductShipmentRepository extends EntityRepository
{

}