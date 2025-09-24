<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Event;
use App\Entity\EventMember;

class EventMemberCrudControllerTest extends WebTestCase
{
    public function testAddRemoveMember(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $event = new Event(); $event->setTitle('Event C');
        $em->persist($event); $em->flush();

        $mem = new EventMember(); $mem->setName('User1')->setEvent($event);
        $em->persist($mem); $em->flush();

        $client->request('GET', '/admin?crudAction=removeMember&entityFqcn=App\\Entity\\EventMember&entityId='.$mem->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
