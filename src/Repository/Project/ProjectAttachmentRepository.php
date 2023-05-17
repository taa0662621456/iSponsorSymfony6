<?php

namespace App\Repository\Project;

use App\Entity\Product\ProductAttachment;
use App\RepositoryInterface\Project\ProjectAttachmentRepositoryInterface;
use App\Repository\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttachment[]    findAll()
 * @method ProductAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectAttachmentRepository extends EntityRepository implements ProjectAttachmentRepositoryInterface
{
}
