<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\AttachmentsTrait;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="categories_attachments", indexes={
 * @ORM\Index(name="category_attachment_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoriesAttachments
{
	use BaseTrait;
	use AttachmentsTrait;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories", inversedBy="categoryAttachments")
	 * @ORM\JoinColumn(name="categoryAttachments_id", referencedColumnName="id")
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
	 * @param mixed $categoryAttachments
	 */
	public function setCategoryAttachments($categoryAttachments): void
	{
		$this->categoryAttachments = $categoryAttachments;
	}



}
