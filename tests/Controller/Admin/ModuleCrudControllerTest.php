<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Module;

class ModuleCrudControllerTest extends WebTestCase
{
    public function testEnableDisableModule(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $m = new Module(); $m->setName('Module X');
        $em->persist($m); $em->flush();

        $client->request('GET', '/admin?crudAction=enableModule&entityFqcn=App\\Entity\\Module&entityId='.$m->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=disableModule&entityFqcn=App\\Entity\\Module&entityId='.$m->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
