<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;



class PaymentMethodRepository extends BasePaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.gatewayConfig', 'gatewayConfig')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;
    }

    public function findEnabledForChannel(ChannelInterface $channel): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.enabled = :enabled')
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('channel', $channel)
            ->setParameter('enabled', true)
            ->addOrderBy('o.position')
            ->getQuery()
            ->getResult()
        ;
    }
}
