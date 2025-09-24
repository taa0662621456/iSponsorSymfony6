<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\PaymentGateway;

class PaymentGatewayCrudControllerTest extends WebTestCase
{
    public function testEnableDisableGateway(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $gw = new PaymentGateway(); $gw->setName('PayPal');
        $em->persist($gw); $em->flush();

        $client->request('GET', '/admin?crudAction=enableGateway&entityFqcn=App\\Entity\\PaymentGateway&entityId='.$gw->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=disableGateway&entityFqcn=App\\Entity\\PaymentGateway&entityId='.$gw->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
