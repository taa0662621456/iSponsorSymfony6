<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ObjectCRUDsControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url): void
    {
        $client = self::createClient();

        $client->request('GET', $url);

        $message = 'Not status code 200 ... '.$url;

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
        // ...
    }
}
