<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Role;

class RoleCrudControllerTest extends WebTestCase
{
    public function testAssignRemoveRole(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $role = new Role(); $role->setName('ROLE_ADMIN');
        $em->persist($role); $em->flush();

        $client->request('GET', '/admin?crudAction=assignRole&entityFqcn=App\\Entity\\Role&entityId='.$role->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=removeRole&entityFqcn=App\\Entity\\Role&entityId='.$role->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
