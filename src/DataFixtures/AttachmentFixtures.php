<?php

namespace App\DataFixtures;

use App\Entity\Attachment\Attachment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AttachmentFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
		for ($p = 1; $p <= 3; $p++) {

            $attachment = new Attachment();

            $attachment->setFileName('cover.jpg');
            $attachment->setFilePath('/');
            $attachment->setFileLayoutPosition('homepage');

            $manager->persist($attachment);
            $manager->flush();
		}
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
