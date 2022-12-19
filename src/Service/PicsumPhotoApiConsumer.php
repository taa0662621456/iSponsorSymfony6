<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PicsumPhotoApiConsumer
{

    /**
     * @throws TransportExceptionInterface
     */
    public function getPicsum(): ResponseInterface
    {
        $client = HttpClient::create();
        return $client->request(
            'GET',
            'https://picsum.photos/v2/list',
        );
    }

}
