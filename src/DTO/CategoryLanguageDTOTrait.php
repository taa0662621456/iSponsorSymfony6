<?php

namespace App\DTO;

use App\DTO\Category\CategoryEnGbDTO;
use Symfony\Component\Validator\Constraints as Assert;

trait CategoryLanguageDTOTrait
{
    #[Assert\NotBlank(message: 'categories.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'categories.en.gb.too.short')]
    private string $categoryName = 'category_name';

    #[Assert\NotBlank(message: 'categories.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'categories.en.gb.too.short')]
    private string $categoryDesc = 'category_desc';

    private CategoryEnGbDTO $categoryEnGb;


    public function __construct(string $categoryName, string $categoryDesc, CategoryEnGbDTO $categoryEnGb)
    {
        $this->categoryName = $categoryName;
        $this->categoryDesc = $categoryDesc;
        $this->categoryEnGb = $categoryEnGb;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getCategoryDesc(): string
    {
        return $this->categoryDesc;
    }

    public function setCategoryDesc(string $categoryDesc): void
    {
        $this->categoryDesc = $categoryDesc;
    }

    /**
     * @return CategoryEnGbDTO
     */
    public function getCategoryEnGb(): CategoryEnGbDTO
    {
        return $this->categoryEnGb;
    }

    /**
     * @param CategoryEnGbDTO $categoryEnGb
     */
    public function setCategoryEnGb(CategoryEnGbDTO $categoryEnGb): void
    {
        $this->categoryEnGb = $categoryEnGb;
    }



}
