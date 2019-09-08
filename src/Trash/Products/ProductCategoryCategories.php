<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * ProductCategoryCategories
 *
 * @ORM\Table(name="category_categories", uniqueConstraints={@ORM\UniqueConstraint(name="category_parent_id", columns={"category_parent_id", "category_child_id"})}, indexes={@ORM\Index(name="category_child_id", columns={"category_child_id"}), @ORM\Index(name="ordering", columns={"ordering"})})
 * @ORM\Entity
 */
class ProductCategoryCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="category_parent_id", type="integer", nullable=false)
     *
     * Many ChildCategories have One Category.
     * @ManyToOne(targetEntity="CategoriesCategory", inversedBy="categoryChildId")
     * @JoinColumn(name="category_parent_id", referencedColumnName="id")
     */
    private $categoryParentId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_child_id", type="integer", nullable=false)
     *
     * One Category has Many ChildCategories.
     * @OneToMany(targetEntity="CategoriesCategory", mappedBy="categoryParentId")
     */
    private $categoryChildId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = '0';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCategoryParentId(): int
    {
        return $this->categoryParentId;
    }

    /**
     * @param int $categoryParentId
     */
    public function setCategoryParentId(int $categoryParentId): void
    {
        $this->categoryParentId = $categoryParentId;
    }

    /**
     * @return int
     */
    public function getCategoryChildId(): int
    {
        return $this->categoryChildId;
    }

    /**
     * @param int $categoryChildId
     */
    public function setCategoryChildId(int $categoryChildId): void
    {
        $this->categoryChildId = $categoryChildId;
    }

    /**
     * @return int
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * @param int $ordering
     */
    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    public function __construct() {
        $this->categoryChildId = new ArrayCollection();
    }
}
