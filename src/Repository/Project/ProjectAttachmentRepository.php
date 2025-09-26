<?php


namespace App\Repository\Project;


use App\Entity\Project\ProductAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttachment[]    findAll()
 * @method ProductAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAttachment::class);
    }
}
