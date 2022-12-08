<?php


namespace App\CoreBundle\Doctrine\ORM;





class ProductAssociationRepository extends EntityRepository implements ProductAssociationRepositoryInterface
{
    public function findWithProductsWithinChannel($associationId, ChannelInterface $channel): ProductAssociationInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('associatedProduct')
            ->innerJoin('o.associatedProducts', 'associatedProduct', 'WITH', 'associatedProduct.enabled = true')
            ->innerJoin('associatedProduct.channels', 'channel', 'WITH', 'channel = :channel')
            ->andWhere('o.id = :associationId')
            ->setParameter('associationId', $associationId)
            ->setParameter('channel', $channel)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
