<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\VendorSecurity;

class VendorSecurityCrudControllerTest extends WebTestCase
{
    public function testEnableDisableMfa(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $vs = new VendorSecurity(); $vs->setMfaEnabled(false);
        $em->persist($vs); $em->flush();

        $client->request('GET', '/admin?crudAction=enableMfa&entityFqcn=App\\Entity\\VendorSecurity&entityId='.$vs->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=disableMfa&entityFqcn=App\\Entity\\VendorSecurity&entityId='.$vs->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
