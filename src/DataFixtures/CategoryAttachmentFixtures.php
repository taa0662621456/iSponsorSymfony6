<?php

namespace App\DataFixtures;

use App\Entity\Category\CategoryAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{

		for ($i = 1; $i <= 3; $i++) {

            $categoryAttachment = new CategoryAttachment();

            $manager->persist($categoryAttachment);

            $this->addReference('categoryAttachment_' . $i, $categoryAttachment);
        }
        $manager->flush();

    }

    public function getDependencies (): array
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

        ];
    }

	public function getOrder(): int
    {
		return 8;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['category'];
	}
}
