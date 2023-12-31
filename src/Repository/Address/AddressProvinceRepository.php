<?php

namespace App\Repository\Address;

use App\Entity\Address\Address;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Address\AddressProvinceRepositoryInterface;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressProvinceRepository extends EntityRepository implements AddressProvinceRepositoryInterface
{
}
