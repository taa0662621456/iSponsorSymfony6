<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Featured;

class FeaturedCrudControllerTest extends WebTestCase
{
    public function testAddRemoveFeatured(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $f = new Featured(); $f->setTitle('Feature A');
        $em->persist($f); $em->flush();

        $client->request('GET', '/admin?crudAction=addFeatured&entityFqcn=App\\Entity\\Featured&entityId='.$f->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=removeFeatured&entityFqcn=App\\Entity\\Featured&entityId='.$f->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
