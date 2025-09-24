<?php

namespace App\Service\Entity;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class EntityAction
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly LoggerInterface $logger
    ) {}

    /**
     *
     * @return string|null
     */
    public function getEntityCrudActionName(): ?string
    {
        $request = $this->requestStack->getMainRequest() ?? $this->requestStack->getCurrentRequest();
        if (!$request) {
            $this->logger->warning('No request available to determine CRUD action.');
            return null;
        }

        $routeName = $request->attributes->get('_route');
        if (!$routeName || !str_contains($routeName, '_')) {
            $this->logger->info('Route name is invalid or does not contain an underscore.', ['routeName' => $routeName]);
            return null;
        }

        $parts = explode('_', $routeName);
        return strtolower(array_pop($parts));
    }

}