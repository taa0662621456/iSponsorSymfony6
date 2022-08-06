<?php

namespace App\Repository\Vendor;


use App\Entity\Vendor\VendorMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorMessage[]    findAll()
 * @method VendorMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorMessage::class);
    }

    public function findMessageByConversationId(int $conversationId)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->
        where('m.conversation = :conversationId')
            ->setParameter('conversationId', $conversationId)
            ->orderBy('m.id', 'DESC') //TODO: в конце второго урока была удалена строка

        ;
    }
}
