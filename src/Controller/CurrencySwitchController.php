<?php

namespace App\Controller;

use App\EntityInterface\Channel\ChannelContextInterface;
use App\EntityInterface\Currency\CurrencyInterface;
use App\EntityInterface\Currency\CurrencyContextInterface;
use App\EntityInterface\Currency\CurrencyStorageInterface;
use App\EntityInterface\Vendor\VendorChannelInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[Route('/api/currency')]
final class CurrencySwitchController extends AbstractController
{
    public function __construct(
        private readonly CurrencyContextInterface $currencyContext,
        private readonly CurrencyStorageInterface $currencyStorage,
        private readonly ChannelContextInterface $channelContext,
        private readonly LoggerInterface $logger,
    ) {
    }

    #[Route('/available', name: 'currency_available', methods: ['GET'])]
    public function available(): JsonResponse
    {
        /** @var VendorChannelInterface $vendorChannel */
        $vendorChannel = $this->channelContext->getChannel();

        $availableCurrencies = array_map(
            fn (CurrencyInterface $currency) => $currency->getCode(),
            $vendorChannel->getCurrencies()->toArray(),
        );

        return $this->json([
            'active'     => $this->currencyContext->getCurrencyCode(),
            'currencies' => $availableCurrencies,
        ]);
    }

    #[Route('/switch', name: 'currency_switch_api', methods: ['POST'])]
    public function switchCurrency(Request $request): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        if (!isset($payload['code']) || !is_string($payload['code'])) {
            return $this->json(['error' => 'Currency code missing'], Response::HTTP_BAD_REQUEST);
        }

        $code = strtoupper($payload['code']);

        /** @var VendorChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        try {
            $this->currencyStorage->set($channel, $code);
        } catch (\Throwable $e) {
            $this->logger->error('Currency switch failed', [
                'error' => $e->getMessage(),
                'code'  => $code,
            ]);
            return $this->json(['error' => 'Unable to switch currency'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'message' => 'Currency switched successfully',
            'active'  => $code,
        ]);
    }
}
