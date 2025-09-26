<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\SecurityApiToken;

class SecurityApiTokenCrudControllerTest extends WebTestCase
{
    public function testRevokeRefreshToken(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $token = new SecurityApiToken();
        $token->setToken('tok123');
        $em->persist($token); $em->flush();

        $client->request('GET', '/admin?crudAction=revokeToken&entityFqcn=App\\Entity\\SecurityApiToken&entityId='.$token->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=refreshToken&entityFqcn=App\\Entity\\SecurityApiToken&entityId='.$token->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
