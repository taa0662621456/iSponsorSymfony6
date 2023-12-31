<?php

namespace App\EventListener;

use Webmozart\Assert\Assert;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\SecurityBundle\Security\FirewallMap;
use Symfony\Bundle\SecurityBundle\Security\FirewallConfig;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NonChannelLocaleListener
{
    // TODO: помечен на удаление.
    //    /** @var string[] */
    //    private array $firewallNames;
    //
    //    /**
    //     * @param string[] $firewallNames
    //     */
    //    public function __construct(
    //        private readonly RouterInterface $router,
    //        private readonly LocaleProviderInterface $channelBasedLocaleProvider,
    //        private readonly FirewallMap $firewallMap,
    //        array $firewallNames,
    //    ) {
    //        Assert::notEmpty($firewallNames);
    //        Assert::allString($firewallNames);
    //        $this->firewallNames = $firewallNames;
    //    }
    //
    //    /**
    //     * @throws NotFoundHttpException
    //     */
    //    public function restrictRequestLocale(RequestEvent $event): void
    //    {
    //        if (\method_exists($event, 'isMainRequest')) {
    //            $isMainRequest = $event->isMainRequest();
    //        } else {
    //            /** @phpstan-ignore-next-line */
    //            $isMainRequest = $event->isMasterRequest();
    //        }
    //        if (!$isMainRequest) {
    //            return;
    //        }
    //
    //        $request = $event->getRequest();
    //        /* @psalm-suppress RedundantConditionGivenDocblockType Symfony docblock is not always true */
    //        if ($request->attributes && in_array($request->attributes->get('_route'), ['_wdt', '_profiler', '_profiler_search', '_profiler_search_results'])) {
    //            return;
    //        }
    //
    //        $currentFirewall = $this->firewallMap->getFirewallConfig($request);
    //        if (!$this->isFirewallSupported($currentFirewall)) {
    //            return;
    //        }
    //
    //        $requestLocale = $request->getLocale();
    //        if (!in_array($requestLocale, $this->channelBasedLocaleProvider->getAvailableLocalesCodes(), true)) {
    //            $event->setResponse(
    //                new RedirectResponse(
    //                    $this->router->generate(
    //                        'shop_homepage',
    //                        ['_locale' => $this->channelBasedLocaleProvider->getDefaultLocaleCode()],
    //                    ),
    //                ),
    //            );
    //        }
    //    }
    //
    //    private function isFirewallSupported(?FirewallConfig $firewall = null): bool
    //    {
    //        return
    //            null !== $firewall &&
    //            in_array($firewall->getName(), $this->firewallNames)
    //        ;
    //    }
}
