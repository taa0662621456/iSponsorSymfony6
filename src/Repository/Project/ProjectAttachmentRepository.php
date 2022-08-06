<?php


namespace App\Repository\Project;


use App\Entity\Project\ProjectAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectAttachment[]    findAll()
 * @method ProjectAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectAttachment::class);
    }
}
