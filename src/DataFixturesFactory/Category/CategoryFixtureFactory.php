<?php

namespace App\DataFixturesFactory\Category;

use App\DataFixturesFactoryInterface\Category\CategoryDataFixturesFactoryInterface;
use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Featured\Featured;
use App\Entity\Project\Project;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;
use Doctrine\Common\Collections\Collection;

class CategoryFixtureFactory extends ObjectFactory implements CategoryDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

    public function getCategoryProject(): Collection
    {
        // TODO: Implement getCategoryProject() method.
        return $this->objectFactory->create(Project::class);
    }

    public function setCategoryProject(Project $categoryProject): void
    {
        // TODO: Implement setCategoryProject() method.
    }

    public function getCategoryEnGb(): CategoryEnGb
    {
        // TODO: Implement getCategoryEnGb() method.
        return $this->objectFactory->create(CategoryEnGb::class);
    }

    public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void
    {
        // TODO: Implement setCategoryEnGb() method.
    }

    public function getOrdering(): int
    {
        // TODO: Implement getOrdering() method.
        return $this->objectFactory->create(int::class);
    }

    public function setOrdering(int $ordering): void
    {
        // TODO: Implement setOrdering() method.
    }

    public function getCategoryChildren(): Collection
    {
        // TODO: Implement getCategoryChildren() method.
        return $this->objectFactory->create(Category::class);
    }

    public function addCategoryChildren(Category $categoryChildren): CategoryDataFixturesFactoryInterface
    {
        // TODO: Implement addCategoryChildren() method.
        return $this->objectFactory->create(Category::class);
    }

    public function removeCategoryChildren(Category $categoryChildren): CategoryDataFixturesFactoryInterface
    {
        // TODO: Implement removeCategoryChildren() method.
        return $this->objectFactory->create(Category::class);
    }

    public function getCategoryParent(): Category
    {
        // TODO: Implement getCategoryParent() method.
        return $this->objectFactory->create(Category::class);
    }

    public function setCategoryParent(Category $categoryParent): void
    {
        // TODO: Implement setCategoryParent() method.
    }

    public function getCategoryAttachment(): Collection
    {
        // TODO: Implement getCategoryAttachment() method.
        return $this->objectFactory->create(CategoryAttachment::class);
    }

    public function addCategoryAttachment(CategoryAttachment $categoryAttachment): CategoryDataFixturesFactoryInterface
    {
        // TODO: Implement addCategoryAttachment() method.
        return $this->objectFactory->create(CategoryAttachment::class);
    }

    public function removeCategoryAttachment(CategoryAttachment $categoryAttachment): CategoryDataFixturesFactoryInterface
    {
        // TODO: Implement removeCategoryAttachment() method.
        return $this->objectFactory->create(CategoryAttachment::class);
    }

    public function getCategoryFeatured(): Featured
    {
        // TODO: Implement getCategoryFeatured() method.
        return $this->objectFactory->create(Featured::class);
    }

    public function setCategoryFeatured(Featured $categoryFeatured): void
    {
        // TODO: Implement setCategoryFeatured() method.
    }
}
