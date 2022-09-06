<?php

namespace App\DataFixtures;

use App\Entity\Category\CategoryAttachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryAttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORY_ATTACHMENT_COLLECTION = 'categoryAttachmentCollection';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $attachment = $this->getReference(AttachmentFixtures::ATTACHMENT_COLLECTION);
        $vendor = $this->getReference(VendorFixtures::VENDOR_COLLECTION);

        $categoryAttachmentCollection = new ArrayCollection();

		for ($p = 1; $p <= 3; $p++) {

            $categoryAttachment = new CategoryAttachment();


            $manager->persist($categoryAttachment);
            $manager->flush();

            $categoryAttachmentCollection->add($categoryAttachment);
		}

        $this->addReference(self::CATEGORY_ATTACHMENT_COLLECTION, $categoryAttachment);
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
