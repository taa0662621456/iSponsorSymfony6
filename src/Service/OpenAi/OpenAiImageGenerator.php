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
        private readonly LoggerInterface     $logger,
        private readonly string              $apiKey = '%env(APP_OPENAI_API_KEY)%'
    )
    {
    }

    /**
     * Fetches images from OpenAI API.
     * @throws RedirectionExceptionInterface|ClientExceptionInterface|TransportExceptionInterface|ServerExceptionInterface|Exception
     */
    private function fetchImagesFromOpenAi(string $size): array
    {
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
                    'prompt' => 'user avatar',
                    'size' => $size,
                    'n' => 10,
                ],
            ]
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent(false);

        if ($statusCode !== 200) {
            throw new Exception("OpenAI Request error:\nURL: https://api.openai.com/v1/images/generations\nStatus: $statusCode\nPrompt: user avatar\nRespond: $content");
        }

        $data = json_decode($content, true);

        if (!isset($data['data'])) {
            throw new Exception("OpenAI response does not contain images.");
        }

        $images = [];
        foreach ($data['data'] as $imageData) {
            if (!isset($imageData['url'])) {
                throw new Exception("OpenAI response does not contain image URLs.");
            }

            $imageUrl = $imageData['url'];
            $imageResponse = $this->client->request('GET', $imageUrl);

            if ($imageResponse->getStatusCode() !== 200) {
                throw new Exception("Downloading error: Status {$imageResponse->getStatusCode()}");
            }

            $image = $imageResponse->getContent();
            $imageName = $this->saveImage($image);

            $images[] = [
                'name' => $imageName,
                'size' => filesize($imageName),
                'path' => $imageName,
            ];
        }

        return $images;
    }

    /**
     * Saves image to the file system.
     * @throws Exception
     */
    private function saveImage(string $image): string
    {
        $imageName = $this->getUniqName() . '.jpg';
        $fullPath = rtrim('/path/to/your/images', '/') . '/' . $imageName;

        if (file_put_contents($fullPath, $image) === false) {
            throw new Exception("Failed to save image to '$fullPath'.");
        }

        return $imageName;
    }

    /**
     * Returns a unique name for the image.
     */
    private function getUniqName(): string
    {
        return substr(str_shuffle(str_repeat('0123456789', 9)), 0, 9);
    }

    /**
     * Fallback image in case OpenAI or random image fails.
     * @throws Exception
     */
    private function fallbackImage(): array
    {
        $fallbackPath = '/vendor/fallback_image.jpg';

        if (!file_exists($fallbackPath)) {
            throw new Exception("Fallback image not found at: $fallbackPath");
        }

        return [
            'fileName' => 'fallback_image.jpg',
            'fileSize' => filesize($fallbackPath),
            'filePath' => $fallbackPath,
        ];
    }

    /**
     * Generates or fetches image based on the configuration.
     */
    public function imageFixtureEngine(?array $property, ?string $size = '512x512', ?string $path = ''): array
    {
        try {
            // Try to get a random image first
            $randomImagePicked = (new RandomImagePicker())->getRandomImage();

            if (!$randomImagePicked) {
                $this->logger->info('Using OpenAI image generation// TODO: implement');

                $aiImages = $this->fetchImagesFromOpenAi($size ?? '512x512');
                $aiImageProperty = [
                    'fileName' => $aiImages[0]['name'],
                    'fileSize' => $aiImages[0]['size'],
                    'filePath' => $aiImages[0]['path'],
                ];
            } else {
                $this->logger->info('Using random image from local storage// TODO: implement');

                $aiImageProperty = [
                    'fileName' => $randomImagePicked['name'],
                    'fileSize' => $randomImagePicked['size'],
                    'filePath' => $randomImagePicked['path'],
                ];
            }

            return array_merge($property ?? [], $aiImageProperty);

        } catch (Exception|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
            $this->logger->error('Error generating image: ' . $e->getMessage());

            try {
                // Handle fallback image retrieval, and catch any exceptions
                $fallbackImage = $this->fallbackImage();
                return array_merge($property ?? [], $fallbackImage);
            } catch (Exception $fallbackException) {
                // Log the error for fallback image retrieval
                $this->logger->error('Error fetching fallback image: ' . $fallbackException->getMessage());
                // Return an empty array or some other default fallback behavior if needed
                return array_merge($property ?? [], ['fileName' => 'default_fallback.jpg', 'fileSize' => 0, 'filePath' => '/path/to/default.jpg']);
            }
        }
    }
}