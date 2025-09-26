<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\IdempotencyKeyEntity;

class IdempotencyKeyEntityCrudControllerTest extends WebTestCase
{
    public function testGenerateInvalidateKey(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $key = new IdempotencyKeyEntity(); $key->setKeyValue('abc123');
        $em->persist($key); $em->flush();

        $client->request('GET', '/admin?crudAction=generateKey&entityFqcn=App\\Entity\\IdempotencyKeyEntity&entityId='.$key->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=invalidateKey&entityFqcn=App\\Entity\\IdempotencyKeyEntity&entityId='.$key->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
