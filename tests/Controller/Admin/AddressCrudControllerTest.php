<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Address;

class AddressCrudControllerTest extends WebTestCase
{
    public function testAddUpdateDeleteAddress(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $addr = new Address(); $addr->setStreet('Main st')->setCity('City')->setZip('12345');
        $em->persist($addr); $em->flush();

        $client->request('GET', '/admin?crudAction=updateAddress&entityFqcn=App\\Entity\\Address&entityId='.$addr->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=deleteAddress&entityFqcn=App\\Entity\\Address&entityId='.$addr->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
