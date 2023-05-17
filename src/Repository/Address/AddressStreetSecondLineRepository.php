<?php

namespace App\Repository\Address;

use App\Entity\Address\Address;
use App\Entity\Address\AddressStreet;
use App\Entity\Address\AddressStreetSecondLine;
use App\RepositoryInterface\Address\AddressStreetSecondLineRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AddressStreetSecondLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressStreetSecondLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressStreetSecondLine[]    findAll()
 * @method AddressStreetSecondLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressStreetSecondLineRepository extends EntityRepository implements AddressStreetSecondLineRepositoryInterface
{

}
