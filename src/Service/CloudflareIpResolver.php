<?php

namespace App\Service;

use Karser\Recaptcha3Bundle\Services\IpResolverInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CloudflareIpResolver implements IpResolverInterface
{
    /** @var IpResolverInterface */
    private IpResolverInterface $decorated;

    /** @var RequestStack */
    private RequestStack $requestStack;

    public function __construct(IpResolverInterface $decorated, RequestStack $requestStack)
    {
        $this->decorated = $decorated;
        $this->requestStack = $requestStack;
    }

    public function resolveIp(): ?string
    {
        return $this->doResolveIp() ?? $this->decorated->resolveIp();
    }

    private function doResolveIp(): ?string
    {
        $request = $this->requestStack->getCurrentRequest();
        return $request?->server->get('HTTP_CF_CONNECTING_IP');
    }
}
