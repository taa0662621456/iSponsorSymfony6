<?php

namespace App\Service\Entity;

class EntityLocalisation
{
    private const DEFAULT_ACTION = 'default';

    public function getLocalizedEntityNamespace(string $namespace, string $locale): ?string
    {
        $localisedNamespace = $namespace . ucfirst(str_replace('-', '', $locale));

        return class_exists($localisedNamespace) ? $localisedNamespace : null;
    }

}