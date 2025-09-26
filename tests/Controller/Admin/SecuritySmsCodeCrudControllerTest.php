<?php
namespace App\Tests\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\SecuritySmsCode;

class SecuritySmsCodeCrudControllerTest extends WebTestCase
{
    public function testSendVerifySmsCode(): void
    {
        $client = static::createClient();
        $em = static::getContainer()->get(EntityManagerInterface::class);

        $sms = new SecuritySmsCode(); $sms->setPhone('+100000000')->setCode('1234');
        $em->persist($sms); $em->flush();

        $client->request('GET', '/admin?crudAction=sendCode&entityFqcn=App\\Entity\\SecuritySmsCode&entityId='.$sms->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());

        $client->request('GET', '/admin?crudAction=verifyCode&entityFqcn=App\\Entity\\SecuritySmsCode&entityId='.$sms->getId());
        $this->assertEquals(Response::HTTP_FOUND, $client->getResponse()->getStatusCode());
    }
}
