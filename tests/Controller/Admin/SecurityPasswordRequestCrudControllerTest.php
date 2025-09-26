<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\SecurityPasswordRequest;

class SecurityPasswordRequestCrudControllerTest extends WebTestCase
{
    public function testResetPasswordRequest(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $req = new SecurityPasswordRequest();
        $req->setEmail('user@example.com');
        $em->persist($req); $em->flush();

        $client->request('GET', '/admin?crudAction=resetPassword&entityFqcn=App\\Entity\\SecurityPasswordRequest&entityId='.$req->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
