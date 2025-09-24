<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Storage;

class StorageCrudControllerTest extends WebTestCase
{
    public function testAddRemoveFile(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $s = new Storage(); $s->setSlug('file-a');
        $em->persist($s); $em->flush();

        $client->request('GET', '/admin?crudAction=addFile&entityFqcn=App\\Entity\\Storage&entityId='.$s->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=removeFile&entityFqcn=App\\Entity\\Storage&entityId='.$s->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
