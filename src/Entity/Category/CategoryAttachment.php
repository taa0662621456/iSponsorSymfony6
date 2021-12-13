<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Interface\CategoryInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categories_attachments", indexes={
 * @ORM\Index(name="category_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryAttachmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoryAttachment
{
    use BaseTrait;
    use AttachmentTrait;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Category",
//     *     inversedBy="categoryAttachment")
//     * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id", onDelete="CASCADE")
//     */
//    private Category $categoryAttachments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Interface\CategoryInterface",
     *     inversedBy="categoryAttachments")
     * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private CategoryInterface $categoryAttachments;

    /**
     * @return
	 */
	public function getCategoryAttachments(): CategoryInterface
    {
		return $this->categoryAttachments;
	}

	/**
	 * @param CategoryInterface $categoryAttachments
	 */
	public function setCategoryAttachments(CategoryInterface $categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}


}
