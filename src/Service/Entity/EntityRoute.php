<?php

namespace App\Service\Entity;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class EntityRoute
{
    private const FALLBACK_OBJECT = 'Root';

    public function __construct(
        private readonly RequestStack $requestStack) {}

    public function getEntityRouteNamespace(): ?string
    {
        $request = $this->requestStack->getMainRequest() ?? $this->requestStack->getCurrentRequest();
        if (!$request) {
            return null;
        }

        $attributes = $request->attributes;

        $entity = $attributes->get('entity');
        $subEntity = $attributes->get('subEntity');

        if ($entity && $subEntity) {
            return ucfirst($entity) . ucfirst($subEntity);
        }

        return $entity ? ucfirst($entity) : self::FALLBACK_OBJECT;
    }

    public function getEntityRoute(Request $request)
    {

        return $request->attributes->get('_route');
    }

}
