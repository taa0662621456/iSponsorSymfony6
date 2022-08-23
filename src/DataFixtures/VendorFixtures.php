<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;
use Faker\Generator;

class VendorFixtures extends Fixture
{
    public const VENDOR_COLLECTION = 'vendorCollection';

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

        $vendorCollection = new ArrayCollection();

        $dir = dirname('public\\upload\\vendor\\image\\.');
        $avatarArray = scandir($dir);

        foreach ($avatarArray as $avatar){
            if (!is_dir($avatar)){
                $avatar = 'public/upload/vendor/image/' . $avatar;
                unlink($avatar);
            }
        }
        for ($p = 1; $p <= 1; $p++) {

            $rand = random_int(1000000, 1000000000);
            $requestUrl = 'https://www.thispersondoesnotexist.com/image?' . $rand;

            $filename = $rand . '.jpg';
            $file = 'public\\upload\\vendor\\image\\' . $rand . '.jpg';

            $fp = fopen($file, 'w+');
            $ch = curl_init($requestUrl);

            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 6000);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_setopt($ch, CURLOPT_VERBOSE, false);
            $raw = curl_exec($ch);
            curl_close($ch);

            fwrite($fp, $raw);
            fclose($fp);


            //$password = md5($rand);

            $vendor = new Vendor();
            $vendorSecurity = new VendorSecurity();
            $vendorIban = new VendorIban();
            $vendorEnGb = new VendorEnGb();
            $vendorDocument = new VendorDocument();
            $vendorMedia = new VendorMedia();


            $vendorSecurity->setEmail($faker->email);
            $vendorSecurity->setPassword($faker->password(6, 20));
            $vendorSecurity->setPhone($faker->phoneNumber);
            #
            $vendorEnGb->setVendorZip($faker->numberBetween(11111, 99999));
            $vendorEnGb->setFirstTitle($faker->firstName);
            $vendorEnGb->setLastTitle($faker->lastName);
            #
            $vendorIban->setIban($faker->numberBetween(1111111111111111, 9999999999999999));
            #
            $vendorDocument->setFileName('cover.jpg');
            $vendorDocument->setFilePath('/');
            #
            $vendorMedia->setFileName($filename);
            $vendorMedia->setFilePath('/');
            ####
            $vendor->setVendorEnGb($vendorEnGb);
            $vendor->setVendorSecurity($vendorSecurity);
            $vendor->setVendorIban($vendorIban);
            #
            $manager->persist($vendorDocument);
            $manager->persist($vendorMedia);
            $manager->persist($vendorIban);
            $manager->persist($vendorEnGb);
            $manager->persist($vendorSecurity);
            $manager->persist($vendor);
            $manager->flush();

            $vendorCollection->add($vendor);
        }

        $this->addReference(self::VENDOR_COLLECTION, $vendorCollection);
    }

    public function getDependencies (): array
    {
        return [
        ];
    }

    public function getOrder(): int
    {
		return 1;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['vendor'];
	}
}

