<?php

namespace App\Service\OpenAi;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAiImageGenerator
{

    public function __construct(private readonly HttpClientInterface $client,
                                private readonly string              $apiKey = '%env(APP_OPENAI_API_KEY)%')
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    public function getOpenAiImageGenerated(string $prompt, string $path, string $size = '512x512', ?int $count = 1,): array
    {
        $images = [];

        for ($i = 0; $i < $count; $i++) {
            $image = $this->getOpenAiImageGeneratedByPrompt($prompt, $path, $size);
            $imageName = $this->saveImage($image, $path);
            $images[] = $imageName;
        }

        return $images;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws \Exception
     */
    private function getOpenAiImageGeneratedByPrompt(string $prompt, string $path, string $size): string
    {
        $response = $this->client->request(
            'POST',
            'https://api.openai.com/v1/images/generate', // Замените на актуальный URL эндпоинта
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'dall-e-3',
                    'prompt' => $prompt,
                    'size' => $size,
                ],
            ]
        );

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            throw new \Exception("Ошибка запроса к OpenAI: статус $statusCode");
        }

        $content = $response->getContent();
        $data = json_decode($content, true);

        if (!isset($data['image'])) {
            throw new \Exception("Ответ от OpenAI не содержит изображения.");
        }

        return base64_decode($data['image']);

    }


    /**
     * @throws \Exception
     */
    private function saveImage(string $image, string $path): string
    {
        $imageName = $this->getUniqName() . '.jpg';

        if (file_put_contents($path, base64_decode($image)) === false) {
            throw new \Exception("Не удалось сохранить изображение в '$path'.");
        }

        return $imageName;
    }

    private function getUniqName(): string
    {
        return substr(str_shuffle(str_repeat('0123456789', 9)), 0, 9);
    }
}
