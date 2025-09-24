<?php
namespace App\Service\Category;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryEnGb;
use App\Exception\CategoryNotFoundException;
use App\Repository\Category\CategoryRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class CategoryIndex
{
    private CategoryRepository $categoryRepository;
    private EntityManagerInterface $em;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     *
     * @return Category[]
     * @throws CategoryNotFoundException
     */
    public function getCategory(): array
    {
        // Получаем категории с сортировкой по slug
        $categories = $this->categoryRepository->findBy([], ['slug' => Criteria::ASC]);

        if (empty($categories)) {
            throw new CategoryNotFoundException('No categories found.');
        }

        return array_map(
            fn($category) => $this->mapToCategory($category),
            $categories
        );
    }

    /**
     * Маппинг категории с добавлением данных из локализованной сущности (например, CategoryEnGb)
     *
     * @param Category $category
     * @return Category
     */
    private function mapToCategory(Category $category): Category
    {
        $categoryEnGb = $category->getCategoryEnGb();

        // Используем локализованный title или fallback на дефолтный
        $title = $categoryEnGb ? $categoryEnGb->getFirstTitle() : $category->getTitle();

        return (new Category())
            ->setId((int) $category->getId())
            ->setTitle($title)
            ->setSlug($category->getSlug());
    }

    /**
     * Получить категорию по ID
     *
     * @param int $id
     * @return Category[]
     * @throws CategoryNotFoundException
     */
    public function getByCategoryId(int $id): array
    {
        // Находим категорию по ID
        $category = $this->categoryRepository->find($id);
        if (null === $category) {
            throw new CategoryNotFoundException("Category with ID {$id} not found.");
        }

        // Возвращаем категории для найденной категории
        return array_map(
            fn($category) => $this->mapToCategory($category),
            $this->categoryRepository->findBy(['category' => $category])
        );
    }

    /**
     * Сохранить новую категорию с локализованными данными
     *
     * @param Category $category
     * @param CategoryEnGb $categoryEnGb
     * @return Category
     */
    public function setCategory(Category $category, CategoryEnGb $categoryEnGb): Category
    {
        return (new Category())
            ->setId((int) $category->getId())
            ->setTitle($categoryEnGb->getFirstTitle()); // Используем локализованный title
    }

    /**
     * Пример метода для синхронизации категорий
     *
     * @param Category $category
     * @return Category
     */
    public function syncCategory(Category $category): Category
    {
        // Сохраняем или обновляем категорию
        $this->em->persist($category);
        $this->em->flush();

        return $category;
    }
}
