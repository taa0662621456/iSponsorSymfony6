<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categories_attachments", indexes={
 * @ORM\Index(name="category_attachment_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoriesAttachmentsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoriesAttachments
{
    use BaseTrait;
    use AttachmentsTrait;

    //TODO: переход на общий attachments
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
     *     inversedBy="attachment")
     * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $attachments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
     *     inversedBy="categoryAttachments")
     * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $categoryAttachments;

    /**
     * @return mixed
	 */
	public function getCategoryAttachments()
	{
		return $this->categoryAttachments;
	}

	/**
	 * @param Categories $categoryAttachments
	 */
	public function setCategoryAttachments(Categories $categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}


}
