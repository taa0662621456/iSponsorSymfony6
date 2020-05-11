<?php


namespace App\Repository\Message;

use App\Entity\Conversation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Conversation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conversation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversation[]    findAll()
 * @method Conversation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConversationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversation::class);
    }

    public function findConversationByParticipants(?int $otherUserId, ?int $currentUserId)
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->select($qb->expr()->count('p.conversation'))
            ->innerJoin('c.participant', 'p')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->eq('p.user', ':my'),
                    $qb->expr()->eq('p.user', ':otherUser')
                )

            /*$qb->expr()->eq('p.user', ':my'),
            $qb->expr()->eq('p.user', ':otherUser')*/
            )
            ->groupBy('p.conversation')
            ->having(
                $qb->expr()->eq(
                    $qb->expr()->count('p.conversation'),
                    2
                )
                    ->setParameters([
                        'me' => $currentUserId,
                        'otherUser' => $otherUserId
                    ])
            );

        return $qb->getQuery()->getResoult();
    }

    public function findConversationByUser(int $userId)
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->select('otherUser.username', 'c.id us conversationId', 'lm.content', 'lm.createdBy')
            ->innerJoin('c.participants', 'p', Join::WITH, $qb->expr()->neq('p.user', ':user'))
            ->innerJoin('c.participants', 'me', Join::WITH, $qb->expr()->eq('me.user', ':user'))
            ->leftJoin('c.lastMessage', 'lm')
            ->innerJoin('me.user', 'meUser')
            ->innerJoin('p.user', 'otherUser')
            ->where('meUser.id = :user')
            ->setParameters('user', $userId)
            ->orderBy('lm.createdBy', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function checkIfUserIsParticipant(int $conversationId, int $userId)
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->innerJoin('c.participants', 'p')
            ->where('c.id = :conversationId')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->eq('p.user', ':userId')
                )
            )
            ->setParameters([
                'conversationId' => $conversationId,
                'userId' => $userId
            ]);

        return $qb->getQuery()->getOneOrNullResult();

    }

}
