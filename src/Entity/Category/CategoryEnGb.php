<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Table(name="categories_en_gb", indexes={
 * @ORM\Index(name="category_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoryEnGb
{
    use BaseTrait;
    use ObjectTrait;

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
	 * @ORM\OneToOne(targetEntity="App\Entity\Category\Category",
	 *     inversedBy="categoryEnGb")
	 */
	private $categoryEnGb;


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
	 * @return mixed
	 */
	public function getCategoryEnGb()
	{
		return $this->categoryEnGb;
	}
}
