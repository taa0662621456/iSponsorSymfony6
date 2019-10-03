<?php

	namespace App\DataFixtures;

	use App\Doctrine\UuidEncoder;
	use App\Entity\Category\Categories;
	use App\Entity\Category\CategoriesAttachments;
	use App\Entity\Category\CategoriesEnGb;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\DataFixtures\DependentFixtureInterface;
	use Doctrine\Common\Persistence\ObjectManager;
	use Doctrine\ORM\EntityManagerInterface;
	use Exception;
	use Ramsey\Uuid\Uuid;

	class CategoriesCategoryFixtures extends Fixture implements DependentFixtureInterface
	{

		public function load(ObjectManager $manager)
		{
			//TODO
			/*		$categoriesRepository = $manager->getRepository(Categories::class);
					$countCategories = count($categoriesRepository->findAll());
					$categories = $categoriesRepository->findAll();

					for ($p = 1; $p <= $countCategories; $p++){
						$category = rand(1,$countCategories);
						$category = $categoriesRepository->find($category);
						$category->setParent($categories[array_rand($categories)]);
						$manager->refresh($category);
						$manager->flush();
					}*/
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
