<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ObjectInitializer
{
    public function __construct(
        private readonly RequestStack    $requestStack,
        private readonly LoggerInterface $logger,
        private readonly string          $entityNamespace, # is global, - bind
        private readonly string          $repositoryNamespace, # is global, - bind
        private readonly string          $typeNamespace, # is global, - bind
        private readonly string          $locale, # is global, - bind
        private ?string                  $object = 'Root',
        private ?string                  $objectRoute = '',
        private ?string                  $objectCrudAction = '',
        private ?string                  $objectTemplatePath = '',
        private ?string                  $objectLocale = '',
        private ?string                  $objectLocaleFilter = '',
        private array                    $objectType = [],
        private array                    $objectEntity = [],
        private array                    $objectRepository = []

    )
    {
        $request = $requestStack->getMainRequest() ?: $requestStack->getCurrentRequest();
        if ($request) {
            $this->fromRequestInitializer($request);
        }
    }

    /**
     * @param $request
     * @return void
     */
    private function fromRequestInitializer($request): void
    {
        $routeParts = explode('_', $request->attributes->get('_route', ''));
        if (count($routeParts) >= 2) {
            [$objectName, $crudAction] = $routeParts;
            $this->object = ucfirst(strtolower($objectName)) ?: 'Root';
            $this->objectRoute = (string)mb_strtolower($objectName);
            $this->objectCrudAction = strtolower($crudAction);
            $this->objectTemplatePath = strtolower($objectName) . '/' . strtolower($objectName) . '/' . strtolower($crudAction) . '.html.twig';
            $this->objectLocale = $request->getLocale();
            $this->objectLocaleFilter = $request->attributes->get('_locale_filter', $this->locale);
            $this->objectInitializer($objectName);
        }
    }


    /**
     * @param string $object
     * @return void
     */
    public function objectInitializer(string $object): void
    {

        $object = ucfirst(strtolower($object));
        $objectEntityClass = $this->entityNamespace . $object . '\\' . $object;
        $objectRepositoryClass = $this->repositoryNamespace . $object . '\\' . $object . 'Repository';
        $objectTypeClass = $this->typeNamespace . $object . '\\' . $object . 'Type';

        if (!class_exists($objectEntityClass)) {
            $this->logger->warning("Класс сущности '{$objectEntityClass}' не найден.");
            $this->requestStack->getSession()->getFlashBag()->add('warning', "Класс сущности '{$objectEntityClass}' не найден.");
            $this->objectEntity[$object] = 'App\Entity\RootEntity';
        } else {
            $this->objectEntity[$object] = $objectEntityClass;
        }

        if (!class_exists($objectRepositoryClass)) {
            $this->logger->warning("Класс репозитория '{$objectRepositoryClass}' не найден.");
            $this->requestStack->getSession()->getFlashBag()->add('warning', "Класс сущности '{$objectEntityClass}' не найден.");
        } else {
            $this->objectRepository[$object] = $objectRepositoryClass;
        }

        if (!class_exists($objectTypeClass)) {
            $this->logger->warning("Класс типа '{$objectTypeClass}' не найден.");
            $this->requestStack->getSession()->getFlashBag()->add('warning', "Класс сущности '{$objectTypeClass}' не найден.");
        } else {
            $this->objectType[$object] = $objectTypeClass;
        }
    }

    public function getObject(?string $object = 'Root'): string
    {
        if ($object == 'Root') {
            return $this->objectEntity[$this->object];
        }
        $this->objectInitializer($object);

        return $this->objectEntity[$object];
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->objectRoute;
    }

    public function getObjectRepository(?string $object = 'Root'): string
    {

        if ($object == 'Root') {
            return $this->objectRepository[$this->object];
        }
        $this->objectInitializer($object);

        return $this->objectRepository[$object];

    }

    public function getObjectAttachment(?string $object = null): string
    {
        if ($object == 'Root') {
            return $this->objectAttachment[$this->object];
        }
        $this->objectInitializer($object);

        return $this->objectAttachment[$object];
    }


    public function getObjectType(?string $object = 'Root'): ?string
    {
        if ($object == 'Root') {
            return $this->objectType[$this->object];
        }
        $this->objectInitializer($object);

        return $this->objectType[$object];
    }

    /**
     * @return string|null
     */
    public function getTemplatePath(): ?string
    {
        return $this->objectTemplatePath ?? null;
    }

    /**
     * @return string|null
     */
    public function getCrudAction(): ?string
    {
        return $this->objectCrudAction ?? null;
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale ?? null;
    }

    /**
     * @return string|null
     */
    public function getLocaleFilter(): ?string
    {
        return $this->localeFilter ?? null;
    }
}
