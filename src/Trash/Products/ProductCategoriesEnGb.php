<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesEnGb
 *
 * @ORM\Table(name="categories_en_gb", uniqueConstraints={@ORM\UniqueConstraint(name="slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesEnGbRepository")
 */
class ProductCategoriesEnGb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", nullable=false, options={"default"="''"})
     */
    private $categoryName = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="category_desc", type="string", nullable=false, options={"default"="''"})
     */
    private $categoryDesc = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_desc", type="string", nullable=false, options={"default"="''"})
     */
    private $metaDesc = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", nullable=false, options={"default"="''"})
     */
    private $metaKey = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_title", type="string", nullable=false, options={"default"="''"})
     */
    private $customTitle = '\'\'';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", nullable=false, options={"default"="''"})
     */
    private $slug = '\'\'';

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }


}
