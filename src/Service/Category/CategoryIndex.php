<?php

namespace App\Service\Category;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryEnGb;
use App\Exception\CategoryNotFoundException;
use Doctrine\Common\Collections\Criteria;
use App\Repository\Category\CategoryRepository;

class CategoryIndex
{
    private readonly CategoryRepository $categoryRepository;

    public function __constructor(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws \Exception
     *
     * @return Category[]
     */
    public function getCategory(): array
    {
        return array_map(
            /*
             * @throws \Exception
             */
            fn ($category) => new Category(
                $category->getId(),
                $category->getTitle(),
                $category->getSlug()
            ),
            $this->categoryRepository->findBy([], ['slug' => Criteria::ASC])
        );
    }

    public function setCategory(Category $category, CategoryEnGb $categoryEnGb)
    {
        return (new Category())
            ->setId((int) $category->getId())
            ->setTitle($category->getCategoryEnGb()->getFirstTitle());
        //            ->setAuthor($category->getAuthor())
        //            ->setIsBestseller($category->isBestseller())
        //            ->setPrice($category->getPrice())
        //            ->setIsbn($category->getIsbn())
        //            ->setPublishedDate($category->getPublishedDate());
    }

    /**
     * @return Category[]
     *
     * @psalm-return array<Book>
     */
    public function getByCategoryId(int $id): array
    {
        $category = $this->categoryRepository->find($id);
        if (null === $category) {
            throw new \CategoryNotFoundException();
        }

        return array_map(
            [$this, 'setCategory'],
            $this->categoryRepository->findBy(['category' => $category])
        );
    }
}
