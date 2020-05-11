<?php


namespace App\Controller\Message;


use App\Entity\Message\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MassageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
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
