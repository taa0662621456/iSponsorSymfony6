<?php

namespace App\Service\PicsumPhoto;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PicsumPhotoDownloader
{
    public function randomImageDownloader($width = 200, $height = 300, ?string $path = '/path/to/save/image.jpg'): string
    {
        $name = round(9, 99999999) . '.jpg';
        $client = HttpClient::create();
        $url = "https://picsum.photos/id/5/{$width}/{$height}";
        $path = 'public\\upload\\vendor\\image\\' . $name;


        try {
            $response = $client->request('GET', $url, ['max_redirects' => 0]);
            if ($response->getHeaders()['location']) {
                $imageUrl = $response->getHeaders()['location'][0];
                $imageContent = file_get_contents($imageUrl);
                file_put_contents($path, $imageContent);
                return $path;
            }
        } catch (TransportExceptionInterface|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return 'some error in the  PicsumPhotoPicker class';
        }

        return $path;
    }
}
