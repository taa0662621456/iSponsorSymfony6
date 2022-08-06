<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class VendorFixtures extends Fixture
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
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


            $password = $rand;
            $phone =
                random_int(10, 99) .
                random_int(100, 999) .
                random_int(100, 999) .
                random_int(10, 99) .
                random_int(10, 99);

            //$password = md5($rand);

            $vendor = new Vendor();
            $vendorSecurity = new VendorSecurity();
            $vendorIban = new VendorIban();
            $vendorEnGb = new VendorEnGb();
            $vendorDocument = new VendorDocument();
            $vendorMedia = new VendorMedia();

            $vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
            $vendorSecurity->setPassword($password);
            $vendorSecurity->setPhone($phone);

            $vendorEnGb->setVendorZip($rand);
            $vendorEnGb->setFirstTitle('VendorFT' . $rand);
            $vendorEnGb->setMiddleTitle('VendorMT' . $rand);
            $vendorEnGb->setLastTitle('VendorLT' . $rand);

            $vendorIban->setIban('0000000000000000');

            $vendorDocument->setFileName('cover.jpg');
            $vendorDocument->setFilePath('/');
//            $vendorDocument->setAttachment($vendor);

            $vendorMedia->setFileName($filename);
            $vendorMedia->setFilePath('/');
//            $vendorMedia->setAttachment($vendor);

            $vendor->setVendorEnGb($vendorEnGb);
            $vendor->setVendorSecurity($vendorSecurity);
            $vendor->setVendorIban($vendorIban);

            $manager->persist($vendorDocument);
            $manager->persist($vendorMedia);
            $manager->persist($vendorIban);
            $manager->persist($vendorEnGb);
            $manager->persist($vendorSecurity);
            $manager->persist($vendor);
            $manager->flush();
        }
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

