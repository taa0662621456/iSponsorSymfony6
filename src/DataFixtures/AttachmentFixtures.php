<?php

namespace App\DataFixtures;

use App\Entity\Attachment\Attachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const ATTACHMENT_COLLECTION = 'attachmentCollection';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $attachmentCollection = new ArrayCollection();
		for ($p = 1; $p <= 3; $p++) {

            $attachment = new Attachment();

            $attachment->setFileName('cover.jpg');
            $attachment->setFilePath('/');
            $attachment->setFileLayoutPosition('homepage');

            $manager->persist($attachment);
            $manager->flush();

            $attachmentCollection->add($attachmentCollection);
		}

        $this->addReference(self::ATTACHMENT_COLLECTION, $attachmentCollection);
	}

    public function getDependencies (): array
    {
        return [
            VendorFixtures::class,
        ];
    }

	public function getOrder(): int
    {
		return 2;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['attachment'];
	}
}
