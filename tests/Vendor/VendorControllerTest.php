<?php

namespace Vendor;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VendorControllerTest extends WebTestCase
{
    public function vendorGetAllTest()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/vendor');

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $data = $response->getContent();

        $this->assertStringContainsString('Vendor', $data);
    }
}
