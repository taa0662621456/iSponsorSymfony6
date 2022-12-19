<?php


namespace App\CoreBundle\Doctrine\ORM;




final class AvatarImageRepository extends EntityRepository implements AvatarImageRepositoryInterface
{
    public function findOneByOwnerId(string $id): ?ImageInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.owner = :ownerId')
            ->setParameter('ownerId', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
