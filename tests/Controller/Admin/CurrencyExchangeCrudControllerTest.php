<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\CurrencyExchange;

class CurrencyExchangeCrudControllerTest extends WebTestCase
{
    public function testRecalculateRate(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $ex = new CurrencyExchange(); $ex->setFromCurrency('USD')->setToCurrency('EUR')->setRate(0.9);
        $em->persist($ex); $em->flush();

        $client->request('GET', '/admin?crudAction=recalculateRate&entityFqcn=App\\Entity\\CurrencyExchange&entityId='.$ex->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
