<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;



class ShippingMethodRepository extends BaseShippingMethodRepository implements ShippingMethodRepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;
    }

    public function findEnabledForChannel(ChannelInterface $channel): array
    {
        return $this->createEnabledForChannelQueryBuilder($channel)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEnabledForZonesAndChannel(array $zones, ChannelInterface $channel): array
    {
        return $this->createEnabledForChannelQueryBuilder($channel)
            ->andWhere('o.zone IN (:zones)')
            ->setParameter('zones', $zones)
            ->addOrderBy('o.position', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    protected function createEnabledForChannelQueryBuilder(ChannelInterface $channel): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.enabled = :enabled')
            ->andWhere('o.archivedAt IS NULL')
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('channel', $channel)
            ->setParameter('enabled', true)
        ;
    }
}
