<?php


namespace App\Repository\ORM_Sylius;

use Doctrine\ORM\EntityManager;

class PromotionRepository extends BasePromotionRepository implements PromotionRepositoryInterface
{
    private AssociationHydrator $associationHydrator;

    public function __construct(EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);

        $this->associationHydrator = new AssociationHydrator($entityManager, $class);
    }

    public function findActiveByChannel(ChannelInterface $channel): array
    {
        $promotions = $this->filterByActive($this->createQueryBuilder('o'))
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('channel', $channel)
            ->addOrderBy('o.priority', 'DESC')
            ->getQuery()
            ->getResult()
        ;

        $this->associationHydrator->hydrateAssociations($promotions, [
            'rules',
        ]);

        return $promotions;
    }
}
