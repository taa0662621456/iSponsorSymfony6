<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorMedia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Filesystem\Filesystem;

final class VendorMediaFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $filesystem = new Filesystem();
        $filesystem->remove('public/upload/vendor/image/');
        $filesystem->mkdir('public/upload/vendor/image/');



        for ($p = 1; $p <= 10; $p++) {

            $vendorMedia = new VendorMedia();

            //$faker->image('public/upload/vendor/image/', 600,600, 'animals');

            $vendorMedia->setFirstTitle($faker->realText(100));
            #
            $vendorMedia->setFileLang($faker->locale);
            $vendorMedia->setFileIsDownloadable(true);
//            $vendorMedia->setFileName('image' . $p);
            $vendorMedia->setFileName('media.jpg');
            #
            $manager->persist($vendorMedia);

            $this->addReference('vendorMedia_' . $p, $vendorMedia);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,
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
		return ['vendor'];
	}
}
