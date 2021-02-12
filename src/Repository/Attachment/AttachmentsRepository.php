<?php
declare(strict_types=1);


namespace App\Repository\Attachment;


use App\Entity\Attachment\Attachments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attachments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attachments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attachments[]    findAll()
 * @method Attachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attachments::class);
    }

}
