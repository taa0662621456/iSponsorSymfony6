<?php

namespace App\Repository\Locale;

use App\Entity\Locale\Locale;
use App\Interface\Locale\LocaleRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method Locale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locale[]    findAll()
 * @method Locale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocaleRepository implements LocaleRepositoryInterface
{

}
