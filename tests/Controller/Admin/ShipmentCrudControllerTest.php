<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Shipment;

class ShipmentCrudControllerTest extends WebTestCase
{
    public function testMarkCancelShipment(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $sh = new Shipment(); $sh->setTracking('trk123');
        $em->persist($sh); $em->flush();

        $client->request('GET', '/admin?crudAction=markShipped&entityFqcn=App\\Entity\\Shipment&entityId='.$sh->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=cancelShipment&entityFqcn=App\\Entity\\Shipment&entityId='.$sh->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
