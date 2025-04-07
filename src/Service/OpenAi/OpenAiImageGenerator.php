<?php

namespace App\Service\OpenAi;

use App\Service\RandomImagePicker;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAiImageGenerator
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly LoggerInterface $logger,
        private readonly string $apiKey = '%env(APP_OPENAI_API_KEY)%'
    ) {}

    public function getOpenAiImageGenerated(
        string $prompt,
        string $path,
        string $size = '512x512',
        ?int $count = 1
    ): array {
        $images = [];

        for ($i = 0; $i < $count; $i++) {
            try {
                // Try to get image from OpenAI
                $imageData = $this->getOpenAiImageGeneratedByPrompt($prompt, $path, $size);
                $imageName = $this->saveImage($imageData, $path);
            } catch (Exception $e) {
                // Log error and fallback to default image
                $this->logger->error('Error generating image: ' . $e->getMessage());

                // Fallback to placeholder
                $imageName = $this->fallbackImage($path);
            } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
                $this->logger->error('HTTP client error: ' . $e->getMessage());
                // Fallback to placeholder if HTTP error occurs
                $imageName = $this->fallbackImage($path);
            }

            $images[] = [
                'name' => $imageName,
                'size' => filesize($path . '/' . $imageName),
                'path' => $path . '/' . $imageName,
            ];
        }

        return $images;
    }

    /**
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    private function getOpenAiImageGeneratedByPrompt(string $prompt, string $path, string $size): string
    {
        // Send request to OpenAI API to generate image
        $response = $this->client->request(
            'POST',
            'https://api.openai.com/v1/images/generations',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'dall-e-3',
                    'prompt' => $prompt,
                    'size' => $size,
                    'n' => 1,
                ],
            ]
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent(false);

        // Handle non-200 status codes
        if ($statusCode !== 200) {
            throw new Exception("OpenAI request error:\nURL: https://api.openai.com/v1/images/generations\nStatus: $statusCode\nPrompt: $prompt\nResponse: $content");
        }

        // Decode the response
        $data = json_decode($content, true);

        // Check if image URL is present
        if (!isset($data['data'][0]['url'])) {
            throw new Exception("OpenAI response does not contain image URL.");
        }

        $imageUrl = $data['data'][0]['url'];

        // Request the image using the URL
        $imageResponse = $this->client->request('GET', $imageUrl);

        if ($imageResponse->getStatusCode() !== 200) {
            throw new Exception("Error downloading image: status {$imageResponse->getStatusCode()}");
        }

        return $imageResponse->getContent();
    }

    /**
     * @throws Exception
     */
    private function saveImage(string $image, string $path): string
    {
        $imageName = $this->getUniqName() . '.jpg';
        $fullPath = rtrim($path, '/') . '/' . $imageName;

        // Save image to disk
        if (file_put_contents($fullPath, $image) === false) {
            throw new Exception("Failed to save image to '$fullPath'.");
        }

        return $imageName;
    }

    /**
     * Main function to generate or fetch image for fixtures
     */
    public function imageFixtureEngine(?array $property, ?string $size, ?string $path = ''): array
    {
        try {
            // Try to fetch a random image
            $randomImagePicked = (new RandomImagePicker())->getRandomImage();

            if (!$randomImagePicked) {
                $this->logger->info('Using OpenAI image generation...');

                // Generate image via OpenAI
                $aiImage = $this->getOpenAiImageGenerated(
                    'user avatar',
                    $path,
                    $size
                );

                $aiImageProperty = [
                    'fileName' => $aiImage[0]['name'],
                    'fileSize' => $aiImage[0]['size'],
                    'filePath' => $aiImage[0]['path'],
                ];
            } else {
                $this->logger->info('Using random image from local storage...');

                $aiImageProperty = [
                    'fileName' => $randomImagePicked['name'],
                    'fileSize' => $randomImagePicked['size'],
                    'filePath' => $randomImagePicked['path'],
                ];
            }

            return array_merge($property, $aiImageProperty);

        } catch (Exception $e) {
            // Log the error
            $this->logger->error('Error generating image: ' . $e->getMessage());

            // Use fallback image if any error occurs
            $fallbackImage = $this->fallbackImage($path);

            // Return fallback image properties
            return array_merge($property, $fallbackImage);
        }
    }

    /**
     * Fallback method for getting a default image if OpenAI or local storage fails
     * @throws Exception
     */
    private function fallbackImage(string $path): array
    {
        // Path to the fallback image
        $fallbackPath = '/path/to/your/fallback/image.jpg';

        // Check if fallback image exists
        if (!file_exists($fallbackPath)) {
            throw new Exception("Fallback image not found at: $fallbackPath");
        }

        return [
            'fileName' => 'fallback_image.jpg',
            'fileSize' => filesize($fallbackPath),
            'filePath' => $fallbackPath,
        ];
    }

    private function getUniqName(): string
    {
        return substr(str_shuffle(str_repeat('0123456789', 9)), 0, 9);
    }
}
