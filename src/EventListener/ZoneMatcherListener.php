<?php

namespace App\EventListener;

use App\Request\RequestAttribute;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

final class ZoneMatcherListener
{
    private RequestMatcherInterface $requestMatcher;

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $matched = $this->requestMatcher->matches($request);

        $request->attributes->set(RequestAttribute::API_ZONE, $matched);
    }
}
