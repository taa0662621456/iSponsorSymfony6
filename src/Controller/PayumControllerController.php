<?php

namespace App\Controller;

use App\Service\WebhookProcessorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/payum', name: 'payum_')]
class PayumControllerController extends AbstractController
{
    public function __construct(private readonly WebhookProcessorInterface $webhooks) {}

    #[Route('/webhook/{gateway}', name: 'webhook', methods: ['POST'])]
    public function webhook(string $gateway, Request $r): Response
    {
        // 1) Проверка сигнатуры заголовков (X-Signature, timestamp, tolerance)
        // 2) Идемпотентность по eventId
        // 3) Обработка статуса платежа
        $processed = $this->webhooks->handle($gateway, $r);
        return new Response($processed ? 'OK' : 'IGNORED');
    }
}
