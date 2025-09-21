<?php

namespace App\Controller\Admin\Dashboard;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DashboardNotificationController
{
    private \GuzzleHttp\Psr7\Uri $hubUri;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly string $environment,
        private readonly LoggerInterface $logger,
        string $hubUri,
    ) {
        $this->hubUri = new \GuzzleHttp\Psr7\Uri($hubUri);
    }

    public function getVersionAction(Request $request): JsonResponse
    {
        $content = [
            'hostname'    => $request->getHost(),
            'locale'      => $request->getLocale(),
            'user_agent'  => $request->headers->get('User-Agent'),
            'environment' => $this->environment,
        ];

        $headers = ['Content-Type' => 'application/json'];

        $hubRequest = new GuzzleRequest(
            Request::METHOD_POST, // не GET с body!
            $this->hubUri,
            $headers,
            json_encode($content)
        );

        try {
            $hubResponse = $this->client->send($hubRequest);
        } catch (RequestException $e) {
            $this->logger->warning('Hub request failed', ['error' => $e->getMessage()]);
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (ConnectException $e) {
            $this->logger->error('Hub connection failed', ['error' => $e->getMessage()]);
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        $decoded = json_decode($hubResponse->getBody()->getContents(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logger->error('Invalid JSON from hub', ['body' => (string) $hubResponse->getBody()]);
            return new JsonResponse(null, Response::HTTP_BAD_GATEWAY);
        }

        return new JsonResponse($decoded);
    }
}
