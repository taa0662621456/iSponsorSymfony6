<?php

namespace App\Repository\Address;

use App\Repository\EntityRepository;
use App\Entity\Address\AddressStreet;
use App\RepositoryInterface\Address\AddressStreetRepositoryInterface;

/**
 * @method AddressStreet|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressStreet|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressStreet[]    findAll()
 * @method AddressStreet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressStreetRepository extends EntityRepository implements AddressStreetRepositoryInterface
{
}
