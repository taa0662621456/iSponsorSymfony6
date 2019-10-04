<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="categories_en_gb", indexes={
 * @ORM\Index(name="category_en_gb_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoriesEnGb
{
	use BaseTrait;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="category_name", type="string", nullable=false, options={"default"="category_name"})
	 * @Assert\NotBlank(message="categories_en_gb.blank_content")
	 * @Assert\Length(min=6, minMessage="categories_en_gb.too_short_content")
	 */
	private $categoryName = 'category_name';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="category_desc", type="text", nullable=false, options={"default"="category_desc"})
	 * @Assert\NotBlank(message="categories_en_gb.blank_content")
	 * @Assert\Length(min=10, minMessage="categories_en_gb.too_short_content")
	 */
	private $categoryDesc = 'category_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="meta_desc", type="text", nullable=false, options={"default"="meta_desc"})
	 * @Assert\NotBlank(message="categories_en_gb.blank_content")
	 * @Assert\Length(min=6, minMessage="categories_en_gb.too_short_content")
	 */
	private $metaDesc = 'meta_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="meta_key", type="text", nullable=false, options={"default"="meta_key"})
	 * @Assert\NotBlank(message="categories_en_gb.blank_content")
	 * @Assert\Length(min=6, minMessage="categories_en_gb.too_short_content")
	 */
	private $metaKey = 'meta_key';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="custom_title", type="text", nullable=false, options={"default"="custom_title"})
	 * @Assert\NotBlank(message="categories_en_gb.blank_content")
	 * @Assert\Length(min=6, minMessage="categories_en_gb.too_short_content")
	 */
	private $customTitle = 'custom_title';


	/**
	 * @return string
	 */
	public function __toString()
	{

		return $this->getCategoryName();

	}

	/**
	 * @return string
	 */
	public function getCategoryName(): string
	{
		return $this->categoryName;
	}

	/**
	 * @param string $categoryName
	 */
	public function setCategoryName(string $categoryName): void
	{
		$this->categoryName = $categoryName;
	}

	/**
	 * @return string
	 */
	public function getCategoryDesc(): string
	{
		return $this->categoryDesc;
	}

	/**
	 * @param string $categoryDesc
	 */
	public function setCategoryDesc(string $categoryDesc): void
	{
		$this->categoryDesc = $categoryDesc;
	}

	/**
	 * @return string
	 */
	public function getMetaDesc(): string
	{
		return $this->metaDesc;
	}

	/**
	 * @param string $metaDesc
	 */
	public function setMetaDesc(string $metaDesc): void
	{
		$this->metaDesc = $metaDesc;
	}

	/**
	 * @return string
	 */
	public function getMetaKey(): string
	{
		return $this->metaKey;
	}

	/**
	 * @param string $metaKey
	 */
	public function setMetaKey(string $metaKey): void
	{
		$this->metaKey = $metaKey;
	}

	/**
	 * @return string
	 */
	public function getCustomTitle(): string
	{
		return $this->customTitle;
	}

	/**
	 * @param string $customTitle
	 */
	public function setCustomTitle(string $customTitle): void
	{
		$this->customTitle = $customTitle;
	}

}
