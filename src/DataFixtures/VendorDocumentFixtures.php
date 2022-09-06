<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorDocument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Filesystem\Filesystem;

class VendorDocumentFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_DOCUMENT_COLLECTION = 'vendorDocumentCollection';

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
	{
        $vendorDocumentCollection = new ArrayCollection();

        $faker = Factory::create();

        $filesystem = new Filesystem();
        $filesystem->remove('public/upload/vendor/document/');
        $filesystem->mkdir('public/upload/vendor/document/');
//        $filesystem->copy('public/upload/pdf.pdf', 'public/upload/vendor/document/pdf.pdf', true);



        for ($p = 1; $p <= 10; $p++) {

//            $fileName = 'pdf' . $p . '.pdf';
//            $twig = new Environment();
//            $twig = $twig->render('_pdf.html.twig');
//            $pdf = new Pdf();
//            $pdf->generate($twig, $fileName, [], true);

            $vendorDocument = new VendorDocument();

            $vendorDocument->setFirstTitle($faker->realText(20));
            #
            $vendorDocument->setFileLang($faker->locale);
            $vendorDocument->setFileIsDownloadable(true);
            #
            $vendorDocument->setFileName('fileName.pdf');//подставить пути
            #
            $manager->persist($vendorDocument);
            $manager->flush();

            $vendorDocumentCollection->add($vendorDocument);
        }

        $this->addReference(self::VENDOR_DOCUMENT_COLLECTION, $vendorDocumentCollection);
	}

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,
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
