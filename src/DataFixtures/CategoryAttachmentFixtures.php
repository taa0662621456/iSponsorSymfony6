<?php

namespace App\DataFixtures;

use App\Entity\Category\CategoryAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryAttachmentFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
		for ($p = 1; $p <= 3; $p++) {

            $categoryAttachment = new CategoryAttachment();

            $categoryAttachment->setFileName('cover.jpg');
            $categoryAttachment->setFilePath('/');
            $categoryAttachment->setFileLayoutPosition('homepage');
//            $categoryAttachment->addCategoryAttachment();

            $manager->persist($categoryAttachment);
            $manager->flush();
		}
	}

    public function getDependencies (): array
    {
        return [
            VendorFixtures::class,
            AttachmentFixtures::class,
            ReviewProjectFixtures::class,
            ReviewProductFixtures::class,
        ];
    }

	public function getOrder(): int
    {
		return 5;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['category'];
	}
}
