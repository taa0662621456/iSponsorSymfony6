<?php

namespace App\Tests\Controller;

use App\Tests\BaseWebTestCase;
use JetBrains\PhpStorm\NoReturn;

class UrlResponse200Test extends BaseWebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    #[NoReturn]
    public function testPageIsSuccessful($url): void
    {
        $client = self::createClient();

        $client->request('GET', $url);

        $message = 'Not status code 200 ... '.$url;

        $output = sprintf("URL: %s, Route: %s, Status Code: %d\n", $url, $client->getRequest()->getPathInfo(), $client->getResponse()->getStatusCode());
    }

    public function urlProvider(): \Generator
    {
        yield ['/'];
        yield ['/homepage'];
        yield ['/vendor'];
        yield ['/vendor/folder'];
        yield ['/order'];
        yield ['/event'];
        yield ['/event/category'];
        yield ['/event/member'];
        yield ['/folder'];
        yield ['/product'];
        yield ['/product/price'];
        yield ['/product/storage'];
        yield ['/product/attachment'];
        yield ['/project'];
        yield ['/project/attachment'];
        yield ['/commission'];
        yield ['/category'];
        yield ['/attachment'];
        yield ['/review/product'];
        yield ['/review/project'];
        yield ['/taxation'];
        yield ['/taxation/zone'];
        yield ['/taxation/category'];
        yield ['/shipment'];
        yield ['/shipment/category'];
        yield ['/payment'];
        yield ['/payment/category'];
        yield ['/coupon'];
        yield ['/currency'];
        yield ['/role'];
        yield ['/storage'];

        yield ['/sponsor'];
        yield ['/attachment'];
        yield ['/product'];
        yield ['/category'];

        yield ['/login'];
        yield ['/registration'];

        yield ['/forgot/email'];
        yield ['/forgot/phone'];

        yield ['/easyadmin'];
        yield ['/easyadmin/login_form'];
        //        yield ['/registration'];
        //        yield ['/registration'];
        //        yield ['/registration'];
    }
}
