<?php


namespace App\Entity\Category;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\CategoryInterface;
use App\Repository\Category\CategoryAttachmentRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'category_attachment')]
#[ORM\Index(columns: ['slug'], name: 'category_attachment_idx')]
#[ORM\Entity(repositoryClass: CategoryAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class CategoryAttachment
{
	use BaseTrait;
	use AttachmentTrait;
    use ObjectTrait;

	#[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachment')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Category $categoryAttachmentCategory;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    # ManyToOne
    public function getCategoryAttachmentCategory(): Category
    {
		return $this->categoryAttachmentCategory;
	}
	public function setCategoryAttachmentCategory(Category $categoryAttachmentCategory): void
	{
        $this->categoryAttachmentCategory = $categoryAttachmentCategory;
	}
}
