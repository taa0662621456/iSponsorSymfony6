<?php


namespace App\Entity\Category;


use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

trait CategoryLanguageTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", nullable=false, options={"default"="category_name"})
     * @Assert\NotBlank(message="categories.en.gb.blank")
     * @Assert\Length(min=6, minMessage="categories.en.gb.too.short")
     */
    private string $categoryName = 'category_name';

    /**
     * @var string
     *
     * @ORM\Column(name="category_desc", type="text", nullable=false, options={"default"="category_desc"})
     * @Assert\NotBlank(message="categories.en.gb.blank")
     * @Assert\Length(min=10, minMessage="categories.en.gb.too.short")
     */
    private string $categoryDesc = 'category_desc';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category\Category",
     *     inversedBy="categoryEnGb")
     */
    private CategoryEnGb $categoryEnGb;


    /**
     * @return string
     */
    #[Pure]
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
     * @return CategoryEnGb
     */
    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }

}
