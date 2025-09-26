<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Locale;

class LocaleCrudControllerTest extends WebTestCase
{
    public function testEnableDisableSetDefault(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $loc = new Locale(); $loc->setCode('en');
        $em->persist($loc); $em->flush();

        $client->request('GET', '/admin?crudAction=enable&entityFqcn=App\\Entity\\Locale&entityId='.$loc->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=disable&entityFqcn=App\\Entity\\Locale&entityId='.$loc->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=setDefault&entityFqcn=App\\Entity\\Locale&entityId='.$loc->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
