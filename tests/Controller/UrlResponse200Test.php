<?php

namespace Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlResponse200Test extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url): void
    {
        $client = self::createClient();

        $client->request('GET', $url);

        $message = 'Not status code 200 ... ' . $url;

        $this->assertNotTrue($client->getResponse()->isSuccessful(), $message);
    }

    public function urlProvider(): \Generator
    {
        yield ['/vendor'];
        yield ['/sponsor'];
        yield ['/attachment'];
        yield ['/product'];
        yield ['/project'];
        yield ['/category'];
        #
        yield ['/login'];
        yield ['/registration'];
        #
        yield ['/forgot/email'];
        yield ['/forgot/phone'];
        #
        yield ['/easyadmin'];
        yield ['/easyadmin/login_form'];
//        yield ['/registration'];
//        yield ['/registration'];
//        yield ['/registration'];
        #
    }
}
