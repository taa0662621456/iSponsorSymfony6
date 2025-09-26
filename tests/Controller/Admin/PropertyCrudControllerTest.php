<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Property;
use App\Entity\PropertyValue;

class PropertyCrudControllerTest extends WebTestCase
{
    public function testAssignValue(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $prop = new Property(); $prop->setName('Size');
        $em->persist($prop); $em->flush();

        $val = new PropertyValue(); $val->setValue('Large')->setProperty($prop);
        $em->persist($val); $em->flush();

        $client->request('GET', '/admin?crudAction=assignValue&entityFqcn=App\\Entity\\Property&entityId='.$prop->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
