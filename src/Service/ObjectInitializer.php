<?php

namespace App\Service;

class ObjectInitializer
{
    public function getEntityClass(string $entity): string
    {
        return sprintf('App\\Entity\\%s', ucfirst($entity));
    }

    public function getTemplatePath(string $entity): string
    {
        return sprintf('templates/%s.html.twig', strtolower($entity));
    }

    public function getCrudAction(string $action): string
    {
        return $action;
    }

    public function getLocale(): string
    {
        return 'en';
    }

    public function getLocaleFilter(): array
    {
        return ['locale' => $this->getLocale()];
    }
}