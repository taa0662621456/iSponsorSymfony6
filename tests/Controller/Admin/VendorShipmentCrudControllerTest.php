<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Vendor;
use App\Entity\VendorShipment;

class VendorShipmentCrudControllerTest extends WebTestCase
{
    public function testAttachDetachVendorShipment(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $vs = new VendorShipment(); $vs->setCode('VS1');
        $em->persist($vs); $em->flush();

        $client->request('GET', '/admin?crudAction=attachShipment&entityFqcn=App\\Entity\\VendorShipment&entityId='.$vs->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=detachShipment&entityFqcn=App\\Entity\\VendorShipment&entityId='.$vs->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
