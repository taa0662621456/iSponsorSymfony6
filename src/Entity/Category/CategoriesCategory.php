<?php
declare(strict_types=1);

namespace App\Entity\Category;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * CategoryCategories
 *
 * @ORM\Table(name="category_categories", uniqueConstraints={
 * @ORM\UniqueConstraint(name="category_parent_id", columns={"category_parent_id", "category_child_id"})}, indexes={
 * @ORM\Index(name="category_child_id", columns={"category_child_id"}),
 * @ORM\Index(name="ordering", columns={"ordering"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource()
 */
class CategoriesCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="category_parent_id", type="integer", nullable=false)
     *
     * Many ChildCategories have One Category.
     * @ManyToOne(targetEntity="App\Entity\Category\CategoriesCategory", inversedBy="categoryChildId")
     * @JoinColumn(name="category_parent_id", referencedColumnName="id")
     */
    private $categoryParentId = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="category_child_id", type="integer", nullable=false)
     *
     * One Category has Many ChildCategories.
     * @OneToMany(targetEntity="App\Entity\Category\CategoriesCategory", mappedBy="categoryParentId")
     */
    private $categoryChildId = 0;

    /**
     * @var int
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = 0;







    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    public function __construct()
    {
        $this->categoryChildId = new ArrayCollection();
    }
}
