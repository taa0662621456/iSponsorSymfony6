<?php

namespace App\Service\Entity;

use Symfony\Component\HttpFoundation\RequestStack;

class EntityRoute
{
    public function __construct(
        private readonly RequestStack $requestStack) {}

    /**
     *
     * @return string|null
     */
    public function getRoute(): ?string
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

        return $entity ? ucfirst($entity) : 'Root'; // Default to 'Root' если нет сущности
    }

}
