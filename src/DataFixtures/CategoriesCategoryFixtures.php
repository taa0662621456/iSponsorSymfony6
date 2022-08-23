<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Vendor\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class CategoriesCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORIES_CATEGORY_COLLECTION = 'categoriesCategoryCollection';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {

        $categoriesRepository = $manager->getRepository(Category::class)->findAll();

        $categoriesCategoryCollection = new ArrayCollection();
        $array = [];
        $i = 1;
        foreach ($categoriesRepository as $category) {
            $array[$i++] = $category->getId();
        }
        $minId = min($array);
        $maxId = max($array);

        for ($p = 0; $p <= count($categoriesRepository) - 1; $p++) {

            $currentCategoryId = $maxId - $p;
            //$currentCategory = $manager->getRepository(Category::class)->find($currentCategoryId);
            $randomId = random_int($minId, $minId + 4);
            $parentCategory = $manager->getRepository(Category::class)->find($randomId);
            $categoriesCategoryCollection->add($parentCategory);
            if ($currentCategoryId >= ($minId + 4)) {
//                $parentCategory->addCategoryChildren($repository);
                $manager->persist($parentCategory);
                $manager->flush();
            }
        }

        $this->addReference(self::CATEGORIES_CATEGORY_COLLECTION, $categoriesCategoryCollection);
    }

    public function getDependencies(): array
    {
        return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
            ReviewProductFixtures::class,
            CategoryAttachmentFixtures::class,
            ProjectTypeFixtures::class,
            ProjectAttachmentFixtures::class,
            ProjectTagFixtures::class,
            OrderStatusFixtures::class,
            ProjectFixtures::class,
            ProductFixtures::class,
            OrderFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 13;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['category'];
    }
}
