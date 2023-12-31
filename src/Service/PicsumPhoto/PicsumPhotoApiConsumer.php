<?php

namespace App\Service\PicsumPhoto;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
