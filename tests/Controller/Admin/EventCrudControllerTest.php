<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Event;

class EventCrudControllerTest extends WebTestCase
{
    public function testPublishCancelEvent(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $ev = new Event(); $ev->setTitle('Event A');
        $em->persist($ev); $em->flush();

        $client->request('GET', '/admin?crudAction=publishEvent&entityFqcn=App\\Entity\\Event&entityId='.$ev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=cancelEvent&entityFqcn=App\\Entity\\Event&entityId='.$ev->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
