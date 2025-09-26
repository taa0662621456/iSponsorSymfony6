<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class CurrencySwitchController
{
    public function __construct(
        private readonly Environment              $templatingEngine,
        private readonly CurrencyContextInterface $currencyContext,
        private readonly CurrencyStorageInterface $currencyStorage,
        private readonly ChannelContextInterface  $channelContext,
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

        return new Response($this->templatingEngine->render('_currencySwitch.html.twig', [
            'active' => $this->currencyContext->getCurrencyCode(),
            'currencies' => $availableCurrencies,
        ]));
    }

    public function switchAction(Request $request, string $code): Response
    {
        /** @var VendorChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        $this->currencyStorage->set($channel, $code);

        return new RedirectResponse($request->headers->get('referer', $request->getSchemeAndHttpHost()));
    }
}
