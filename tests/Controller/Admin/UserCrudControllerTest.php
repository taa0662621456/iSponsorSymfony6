<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;

class UserCrudControllerTest extends WebTestCase
{
    public function testActivateDeactivateUser(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $user = new User(); $user->setEmail('test@example.com');
        $em->persist($user); $em->flush();

        $client->request('GET', '/admin?crudAction=activateUser&entityFqcn=App\\Entity\\User&entityId='.$user->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=deactivateUser&entityFqcn=App\\Entity\\User&entityId='.$user->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
