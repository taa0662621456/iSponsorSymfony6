<?php


namespace App\Entity\Category;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\SlugTitleFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Interface\Category\CategoryInterface;
use App\Repository\Category\CategoryAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'category_attachment')]
#[ORM\Index(columns: ['slug'], name: 'category_attachment_idx')]
#[ORM\Entity(repositoryClass: CategoryAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class CategoryAttachment
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    use MetaTrait;
    # API Filters
    use TimestampFilterTrait;
    use AttachmentTrait;
    use RelationFilterTrait;

	#[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachment')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Category $categoryAttachmentCategory;

    # ManyToOne
    public function getCategoryAttachmentCategory(): Category
    {
		return $this->categoryAttachmentCategory;
	}
	public function setCategoryAttachmentCategory(Category $category): void
	{
        $this->categoryAttachmentCategory = $category;
	}

}
