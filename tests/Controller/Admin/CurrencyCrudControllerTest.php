<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Currency;

class CurrencyCrudControllerTest extends WebTestCase
{
    public function testActivateDeactivateCurrency(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $cur = new Currency(); $cur->setCode('USD');
        $em->persist($cur); $em->flush();

        $client->request('GET', '/admin?crudAction=activateCurrency&entityFqcn=App\\Entity\\Currency&entityId='.$cur->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=deactivateCurrency&entityFqcn=App\\Entity\\Currency&entityId='.$cur->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
