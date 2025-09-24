<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GptExceptionConsulter
    {
        private string $apiKey;
        private string $gptApiUrl;

        public function __construct(ParameterBagInterface $parameterBag)
        {
            $this->apiKey = $parameterBag->get('app_gpt_consulter');
            $this->gptApiUrl = $parameterBag->get('app_gpt_url');
        }

    #[NoReturn] public function generateComment(string $className, string $exceptionMessage): string
    {
        // Отправьте запрос к GPT-4 API, передав информацию о классе и сообщении об ошибке.
        $client = new Client();
        try {
            $response = $client->post($this->gptApiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'OpenAI-Organization' => 'org-hvb6xbYAKWtg3dtMXKeeAMQp',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => 'Вот новая ощибка' . $className . ' ' . $exceptionMessage,
                        ],
                    ],
                    'temperature' => 0.7,
                ],
            ]);
        } catch (GuzzleException $e) {
        }

        $data = json_decode($response->getBody(), true);
        $content = $data["choices"][0]["message"]["content"];

        dd($content);
        return $data['comment'] ?? 'Не удалось получить комментарий от GPT-4 API.';
    }

    #[NoReturn] public function generateText(string $errorDescription): string
    {
        $httpClient = HttpClient::create();

        try {
            $response = $httpClient->request('POST', $this->gptApiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'json' => [
                    'prompt' => 'Решите следующую ошибку: ' . $errorDescription,
                ],
            ]);
        } catch (TransportExceptionInterface $e) {
        }

        dd('$vars');
        try {
            $data = $response->toArray();
        } catch (ClientExceptionInterface|TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|DecodingExceptionInterface $e) {
        }
        return $data['choices'][0]['text'] ?? 'Не удалось получить ответ от GPT-4 API.';
    }
}
