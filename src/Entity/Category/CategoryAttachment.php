<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Category",
     *     inversedBy="categoryAttachment")
     * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private Category $categoryAttachments;

    /**
     * @return
	 */
	public function getCategoryAttachments()
	{
		return $this->categoryAttachments;
	}

	/**
	 * @param Category $categoryAttachments
	 */
	public function setCategoryAttachments(Category $categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}


}
