<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorMedia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Filesystem\Filesystem;

class VendorMediaFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_MEDIA_COLLECTION = 'vendorMediaCollection';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $vendorMediaCollection = new ArrayCollection();

        $faker = Factory::create();

        $filesystem = new Filesystem();
        $filesystem->remove('public/upload/vendor/image/');
        $filesystem->mkdir('public/upload/vendor/image/');



        for ($p = 1; $p <= 10; $p++) {

            $vendorMedia = new VendorMedia();

            $faker->image('public/upload/vendor/image/', 600,600, 'animals');

            $vendorMedia->setFirstTitle($faker->realText(100));
            #
            $vendorMedia->setFileLang($faker->locale);
            $vendorMedia->setFileIsDownloadable(true);
//            $vendorMedia->setFileName('image' . $p);
            $vendorMedia->setFileName('media.jpg');
            #
            $manager->persist($vendorMedia);
            $manager->flush();

            $vendorMediaCollection->add($vendorMedia);
        }

        $this->addReference(self::VENDOR_MEDIA_COLLECTION, $vendorMediaCollection);
	}

    public function getDependencies(): array
    {
        return [
            VendorDocumentFixtures::class,
            VendorEnGbFixtures::class,
            VendorIbanFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 4;
    }
    /**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['vendor'];
	}
}
