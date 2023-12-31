<?php

namespace App\Repository\Address;

use App\Repository\EntityRepository;
use App\Entity\Address\AddressStreetSecondLine;
use App\RepositoryInterface\Address\AddressStreetSecondLineRepositoryInterface;

/**
 * @method AddressStreetSecondLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressStreetSecondLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressStreetSecondLine[]    findAll()
 * @method AddressStreetSecondLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressStreetSecondLineRepository extends EntityRepository implements AddressStreetSecondLineRepositoryInterface
{
}
