<?php


namespace App\Entity\Category;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Interface\CategoryInterface;
use App\Repository\Category\CategoryAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'categories_attachments')]
#[ORM\Index(columns: ['slug'], name: 'category_attachment_idx')]
#[ORM\Entity(repositoryClass: CategoryAttachmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class CategoryAttachment
{
	use BaseTrait;
	use AttachmentTrait;
	#[ORM\ManyToOne(targetEntity: CategoryInterface::class, inversedBy: 'categoryAttachments')]
	#[ORM\JoinColumn(name: 'categoryAttachments_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private CategoryInterface $categoryAttachments;

    /**
     * @return CategoryInterface
     */
	public function getCategoryAttachments(): CategoryInterface
    {
		return $this->categoryAttachments;
	}
	public function setCategoryAttachments(CategoryInterface $categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}
}
