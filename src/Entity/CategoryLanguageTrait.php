<?php


namespace App\Entity;


use App\Entity\Category\Category;
use App\Entity\Category\CategoryEnGb;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

trait CategoryLanguageTrait
{

    #[ORM\Column(name: 'category_name', type: 'string', nullable: false, options: ['default' => 'category_name'])]
    #[Assert\NotBlank(message: 'categories.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'categories.en.gb.too.short')]
    private string $categoryName = 'category_name';


    #[ORM\Column(name: 'category_desc', type: 'text', nullable: false, options: ['default' => 'category_desc'])]
    #[Assert\NotBlank(message: 'categories.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'categories.en.gb.too.short')]
    private string $categoryDesc = 'category_desc';

    #[ORM\OneToOne(inversedBy: 'categoryEnGb', targetEntity: Category::class)]
    #[Ignore]
    private CategoryEnGb $categoryEnGbCategory;


    /**
     * @return string
     */
    #[Pure]
    public function __toString()
    {
        return $this->getCategoryName();
    }
    #
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }
    #
    public function getCategoryDesc(): string
    {
        return $this->categoryDesc;
    }
    public function setCategoryDesc(string $categoryDesc): void
    {
        $this->categoryDesc = $categoryDesc;
    }
    # OneToOne
    public function getCategoryEnGbCategory(): CategoryEnGb
    {
        return $this->categoryEnGbCategory;
    }

}
