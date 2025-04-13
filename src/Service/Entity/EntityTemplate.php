<?php

namespace App\Service\Entity;

class EntityTemplate
{
    private const DEFAULT_ACTION = 'index';

    public function __construct(
        private readonly string $templateBasePath = 'default') {}

    public function getTemplatePath(string $route, ?string $action = null): string
    {
        $action = $action ?? self::DEFAULT_ACTION;

        return sprintf('%s/%s/%s.html.twig', $route, $route, $action);
    }

    public function getDefaultAction(): string
    {
        return self::DEFAULT_ACTION;
    }

}
