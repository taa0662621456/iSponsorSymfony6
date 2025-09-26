<?php

namespace App\EventListener;

use App\Request\AttributeRequest;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ZoneMatcherListener
{
    private RequestMatcherInterface $requestMatcher;

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $matched = $this->requestMatcher->matches($request);

        $request->attributes->set(AttributeRequest::API_ZONE, $matched);
    }
}
