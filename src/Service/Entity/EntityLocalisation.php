<?php

namespace App\Service\Entity;

class EntityLocalisation
{
    public function getLocalizedEntityNamespace(string $namespace, string $locale): ?string
    {
        $localisedNamespace = $namespace . ucfirst(str_replace('-', '', $locale));

        return class_exists($localisedNamespace) ? $localisedNamespace : null;
    }

    public function getLocalizedTemplatePath(string $route, string $locale, ?string $action = null): string
    {
        $action = $action ?? 'index';
        return sprintf('%s/%s/%s.%s.twig', $route, $action, $locale, $locale);
    }


}
