<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Event;
use App\Entity\EventCategory;

class EventCategoryCrudControllerTest extends WebTestCase
{
    public function testLinkCategory(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $ec = new EventCategory(); $ec->setName('Conf');
        $em->persist($ec);
        $event = new Event(); $event->setTitle('Event B');
        $em->persist($event);
        $em->flush();

        $client->request('GET', '/admin?crudAction=linkCategory&entityFqcn=App\\Entity\\EventCategory&entityId='.$ec->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
