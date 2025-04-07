<?php

namespace App\Controller;

use App\EntityInterface\Channel\ChannelContextInterface;
use App\EntityInterface\Currency\CurrencyInterface;
use App\EntityInterface\Vendor\VendorChannelInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class CurrencySwitchController
{
    public function __construct(
        private readonly Environment $templatingEngine,
        private readonly CurrencyContextInterface $currencyContext,
        private readonly CurrencyStorageInterface $currencyStorage,
        private readonly ChannelContextInterface $channelContext,
    ) {
    }

    public function renderAction(): Response
    {
        /** @var VendorChannelInterface $vendorChannel */
        $vendorChannel = $this->channelContext->getChannel();

        $availableCurrencies = array_map(
            fn (CurrencyInterface $currency) => $currency->getCode(),
            $vendorChannel->getCurrencies()->toArray(),
        );

        try {
            return new Response($this->templatingEngine->render('_currencySwitch.html.twig', [
                'active' => $this->currencyContext->getCurrencyCode(),
                'currencies' => $availableCurrencies,
            ]));
        } catch (LoaderError|SyntaxError|RuntimeError $e) {
        }
    }

    public function switchAction(Request $request, string $code): Response
    {
        /** @var VendorChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        $this->currencyStorage->set($channel, $code);

        return new RedirectResponse($request->headers->get('referer', $request->getSchemeAndHttpHost()));
    }
}
