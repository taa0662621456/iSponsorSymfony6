<?php

namespace App\Tests\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use PHPUnit\Framework\TestCase;
use Doctrine\Persistence\ObjectRepository;

class VendorRepositoryMockingTest extends TestCase
{
    public function testVendorMockingRepository()
    {
        $vendor = new Vendor();
        $vendor->setLocale('Ru-ru');
        $vendor->setPublished(true);

        $vendorRepository = $this->createMock(ObjectRepository::class);

        $vendorRepository->expects($this->any())
            ->method('getRepository')
            ->willReturn($vendorRepository);

        // TODO: HELP https://symfony.com/doc/current/testing/database.html
    }
}
