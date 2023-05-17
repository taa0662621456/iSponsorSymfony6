<?php

namespace App\Repository\Category;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Category\CategoryAttachment;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Category\CategoryAttachmentRepositoryInterface;

/**
 * @method CategoryAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryAttachment[]    findAll()
 * @method CategoryAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryAttachmentRepository extends EntityRepository implements CategoryAttachmentRepositoryInterface
{
}
