<?php

namespace App\Repository\Message;


use App\Entity\Message\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }

    public function findParticipantByConversationIdAndUserId(int $conversationId, int $userId)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->
        where(
            $qb->expr()->andX(
                $qb->expr()->eq('p.conversation', ':conversationId'),
                $qb->expr()->neq('p.user', ':userId')
            )
        )
            ->setParameters([
                'conversationId' => $conversationId,
                'userId' => $userId
            ]);
        return $qb->getQuery()->getOneOrNullResult();
    }
}
