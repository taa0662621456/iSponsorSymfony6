<?php

namespace App\DataFixtures;

use App\Service\PicsumPhotoApiConsumer;
use App\Service\ThisPersonDoesNotExistPhotoConsumer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Filesystem\Filesystem;

class AttachmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const ATTACHMENT_COLLECTION = 'attachmentCollection';

    /**
     * @throws \Exception
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();


        $filesystem = new Filesystem();
        $filesystem->remove('public/upload/vendor/image/');

        $picsumPhotoApiConsumer = new PicsumPhotoApiConsumer();

        $picsum = $picsumPhotoApiConsumer->getPicsum('GET', 'https://picsum.photos/v2/list')->toArray();
        $picsum = array_rand($picsum);

        $vendor = $this->getReference(VendorFixtures::VENDOR_COLLECTION);
        $project = $this->getReference(ProjectFixtures::PROJECT_COLLECTION);
        $product = $this->getReference(ProductFixtures::PRODUCT_COLLECTION);
//        $productAttachment = $this->getReference(ProductAttachmentFixtures::PROJECT_COLLECTION);
        $category = $this->getReference(CategoryFixtures::CATEGORY_COLLECTION);
        $categoryAttachment = $this->getReference(CategoryAttachmentFixtures::CATEGORY_ATTACHMENT_COLLECTION);
//        $projectMedia = $this->getReference();
//        $projectDocument = $this->getReference();


//        $dir = dirname('public\\upload\\vendor\\image\\.');
//        $avatarArray = scandir($dir);


//        foreach ($avatarArray as $avatar){
//            if (!is_dir($avatar)){
//                $avatar = 'public/upload/vendor/image/' . $avatar;
//                unlink($avatar);
//            }
//        }

        for ($p = 1; $p <= 10; $p++) {

            $person = new ThisPersonDoesNotExistPhotoConsumer();

            $personName = random_int(1000000, 1000000000) . '.jpg';
            $path = 'public\\upload\\vendor\\image\\' . $personName;

            $person->getExitPersonPhoto($personName, $path);


            $attachmentCollection = new ArrayCollection();

            for ($p = 1; $p <= 3; $p++) {

                $attachment = new Attachment();

                $attachment->setFileName($personName);
                $attachment->setAttachmentCategoryAttachment();
                $attachment->setAttachmentProductAttachment();
                $attachment->setAttachmentProjectAttachment();
                $attachment->setAttachmentVendorDocument();
                $attachment->setAttachmentVendorMedia();

                $manager->persist($attachment);
                $manager->flush();

                $attachmentCollection->add($attachmentCollection);
            }
        }

        $this->addReference(self::ATTACHMENT_COLLECTION, $attachmentCollection);
	}

    public function getDependencies(): array
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


    public function setProjectMediaAttachment($projectMedia)
    {
        $keys = $projectMedia->getKeys();
        $key = array_rand($keys);

        return $projectMedia->filter($key);
    }

    public function setProjectDocumentAttachment(): void
    {
        dd();
    }

    public function setProductAttachment(): void
    {
        dd();
    }

    public function setCategoryAttachment(): void
    {
        dd();
    }

    public function setVendorAttachment(): void
    {
        dd();
    }
}
