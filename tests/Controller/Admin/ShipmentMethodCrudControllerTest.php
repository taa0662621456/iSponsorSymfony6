<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\ShipmentMethod;

class ShipmentMethodCrudControllerTest extends WebTestCase
{
    public function testEnableDisableMethod(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $sm = new ShipmentMethod(); $sm->setName('UPS');
        $em->persist($sm); $em->flush();

        $client->request('GET', '/admin?crudAction=enableMethod&entityFqcn=App\\Entity\\ShipmentMethod&entityId='.$sm->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=disableMethod&entityFqcn=App\\Entity\\ShipmentMethod&entityId='.$sm->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
