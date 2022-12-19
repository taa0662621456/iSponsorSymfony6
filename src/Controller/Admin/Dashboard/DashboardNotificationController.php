<?php

namespace App\Controller\Admin\Dashboard;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use Http\Message\MessageFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class DashboardNotificationController
{
    private Uri $hubUri;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly MessageFactory  $messageFactory,
        string                           $hubUri,
        private readonly string          $environment,
    ) {
        $this->hubUri = new Uri($hubUri);
    }

    public function getVersionAction(Request $request): JsonResponse
    {
        $content = [
            'hostname' => $request->getHost(),
            'locale' => $request->getLocale(),
            'user_agent' => $request->headers->get('User-Agent'),
            'environment' => $this->environment,
        ];

        $headers = ['Content-Type' => 'application/json'];

        $hubRequest = $this->messageFactory->createRequest(
            Request::METHOD_GET,
            $this->hubUri,
            $headers,
            json_encode($content),
        );

        try {
            $hubResponse = $this->client->send($hubRequest, ['verify' => false]);
        } catch (GuzzleException) {
            return new JsonResponse('', JsonResponse::HTTP_NO_CONTENT);
        }

        $hubResponse = json_decode($hubResponse->getBody()->getContents(), true);

        return new JsonResponse($hubResponse);
    }
}
