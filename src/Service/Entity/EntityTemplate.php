<?php

namespace App\Service\Entity;

class EntityTemplate
{
    private const DEFAULT_ACTION = 'index';

    public function getEntityTemplatePath(string $route, ?string $action = null): string
    {
        $action = $action ?? self::DEFAULT_ACTION;

        return sprintf('%s/%s/%s.html.twig', $route, $route, $action);
    }

    public function getLocalizedTemplatePath(string $route, string $locale, ?string $action = null): string
    {
        $action = $action ?? self::DEFAULT_ACTION;
        return sprintf('%s/%s/%s.%s.twig', $route, $action, $locale, $locale);
    }



}
