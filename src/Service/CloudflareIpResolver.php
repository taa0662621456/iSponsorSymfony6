<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Karser\Recaptcha3Bundle\Services\IpResolverInterface;

class CloudflareIpResolver implements IpResolverInterface
{
    private IpResolverInterface $decorated;

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