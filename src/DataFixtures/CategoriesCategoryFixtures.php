<?php

	namespace App\DataFixtures;

	use App\Entity\Category\Categories;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\DataFixtures\DependentFixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;

	class CategoriesCategoryFixtures extends Fixture implements DependentFixtureInterface
	{

		public function load(ObjectManager $manager)
		{
			$categoriesRepository = $manager->getRepository(Categories::class);
			$countCategories = count($categoriesRepository->findAll());
			$categories = $categoriesRepository->findAll();

			$array = [];
			$i = 1;
			foreach ($categories as $category) {
				$int = $category->getId();
				$array[$i] = $int;
				$i++;
			}
			$minId = min($array);
			$maxId = max($array);

			for ($p = 0; $p <= $countCategories - 1; $p++) {
				$currentCategoryId = $maxId - $p;
				$currentCategory = $categoriesRepository->find($currentCategoryId);
				$parent = rand($minId, $minId + 4);
				$parentCategory = $categoriesRepository->find($parent);

				if ($currentCategoryId >= ($minId + 4)) {
					$currentCategory->setParent($parentCategory);
					$manager->persist($currentCategory);
					$manager->flush();
				}
			}
		}

		public function getDependencies()
		{
			return array(
				CategoriesFixtures::class,
			);
		}

		/**
		 * @return int
		 */
		public function getOrder()
		{
			return 2;
		}

		/**
		 * @return string[]
		 */
		public static function getGroups(): array
		{
			return ['categories'];
		}
	}
