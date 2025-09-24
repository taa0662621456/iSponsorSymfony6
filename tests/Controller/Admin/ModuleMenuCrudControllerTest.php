<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\ModuleMenu;

class ModuleMenuCrudControllerTest extends WebTestCase
{
    public function testAddRemoveMenuItem(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $mm = new ModuleMenu(); $mm->setTitle('MenuItem');
        $em->persist($mm); $em->flush();

        $client->request('GET', '/admin?crudAction=addMenuItem&entityFqcn=App\\Entity\\ModuleMenu&entityId='.$mm->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=removeMenuItem&entityFqcn=App\\Entity\\ModuleMenu&entityId='.$mm->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
