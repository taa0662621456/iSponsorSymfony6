<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Category;

class CategoryCrudControllerTest extends WebTestCase
{
    public function testActivateDeactivateCategory(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $cat = new Category(); $cat->setTitle('Cat A');
        $em->persist($cat); $em->flush();

        $client->request('GET', '/admin?crudAction=activateCategory&entityFqcn=App\\Entity\\Category&entityId='.$cat->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=deactivateCategory&entityFqcn=App\\Entity\\Category&entityId='.$cat->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
