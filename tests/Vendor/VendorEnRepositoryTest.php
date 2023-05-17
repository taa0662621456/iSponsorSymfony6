<?php

namespace Vendor;


use App\Factory\Vendor\VendorEnUsFixtureFactory;
use App\Repository\Vendor\VendorEnGbRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VendorEnRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private VendorEnGbRepository $vendorEnGbRepository;

    public function vendorEnCreateTest()
    {
        $vendorEn = VendorEnUsFixtureFactory::createVendorEnUsEntity('Mike', 'Douglas');

        $this->entityManager->persist($vendorEn);
        $this->entityManager->flush();

        $this->assertNotNull($vendorEn->getId());

        $findVendorEnById = $this->vendorEnGbRepository->findOneBy(['id' => $vendorEn->getId()]);

        $this->assertEquals('test VendorEn firstTitle', $findVendorEnById->getFirstTitle());
        $this->assertEquals('test VendorEn lastTitle', $findVendorEnById->getLastTitle());
    }



    public function setup(): void
    {

        // first step: boot the Symfony kernel
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;

        // second step: get VendorEnRepository from container
        $container = static :: getContainer();
        $this->vendorEnGbRepository = $container->get(VendorEnGbRepository::class);

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }



}
