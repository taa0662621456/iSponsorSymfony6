<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Coupon;

class CouponCrudControllerTest extends WebTestCase
{
    public function testActivateExpireCoupon(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $cp = new Coupon(); $cp->setCode('SALE10');
        $em->persist($cp); $em->flush();

        $client->request('GET', '/admin?crudAction=activateCoupon&entityFqcn=App\\Entity\\Coupon&entityId='.$cp->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=expireCoupon&entityFqcn=App\\Entity\\Coupon&entityId='.$cp->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
