<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorMessage;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\RepositoryInterface\Vendor\VendorMessageRepositoryInterface;

/**
 * @method VendorMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorMessage[]    findAll()
 * @method VendorMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorMessageRepository extends EntityRepository implements VendorMessageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorMessage::class);
    }

    public function findMessageByConversationId(int $conversationId): void
    {
        $qb = $this->createQueryBuilder('m');
        $qb->
        where('m.conversation = :conversationId')
            ->setParameter('conversationId', $conversationId)
            ->orderBy('m.id', 'DESC'); // TODO: в конце второго урока была удалена строка
    }
}