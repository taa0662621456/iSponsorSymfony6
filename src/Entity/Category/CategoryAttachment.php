<?php


namespace App\Entity\Category;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Interface\CategoryInterface;
use App\Repository\Category\CategoryAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
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
