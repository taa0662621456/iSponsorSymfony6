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

    public function load(ObjectManager $manager)
    {

        $categoriesRepository = $manager->getRepository(Category::class)->findAll();

        $array = [];
        $i = 1;
        foreach ($categoriesRepository as $category) {
            $array[$i++] = $category->getId();
        }
        $minId = min($array);
        $maxId = max($array);

        for ($i = 0; $i < count($categoriesRepository); $i++) {

            $currentCategoryId = $maxId - $i;
            $randomId = random_int($minId, $minId + 4);
            $parentCategory = $manager->getRepository(Category::class)->find($randomId);
            if ($currentCategoryId >= ($minId + 4)) {
                $manager->persist($parentCategory);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            VendorFixtures::class,
            #
            CategoryAttachmentFixtures::class,
            CategoryEnGbFixtures::class,
            #
        ];
    }

    public function getOrder(): int
    {
        return 10;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['category'];
    }
}
