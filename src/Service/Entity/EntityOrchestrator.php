<?php

namespace App\Service\Entity;

class EntityOrchestrator
{
    private const FALLBACK_OBJECT = 'Root';

    public function __construct(
        private readonly EntityRepository     $entityRepository,
        private readonly EntityLocalisation   $entityLocalisation,
        private readonly EntityTemplate       $entityTemplate,
        private readonly EntityAttachment     $entityAttachment,
        private readonly EntityRoute          $entityRoute,
        private readonly EntityAction         $entityAction,
    )
    {

    }

    public function getEntityNamespace(?string $object = self::FALLBACK_OBJECT): string
    {

        $object = ucfirst($object);

        if (!isset($this->objectEntity[$object])) {
            $this->objectByPropsInitializer($object);
        }

        return $this->objectEntity[$object] ?? $this->objectEntityNamespace . self::FALLBACK_OBJECT . 'Entity';

    }

    public function getEntityClassName(): string
    {
        return $this->getEntityLocalisedNamespace()
            ?? $this->getEntityNamespace();
    }

    public function getEntityRoutPath(?string $entity = null, ?string $subEntity = null): ?string
    {
        return $this->entityRoute->getEntityRouteNamespace();
    }

    public function getEntityRepositoryNamespace(?string $object = null): ?string
    {
        $objectName = $object ?? $this->object;

        if (!isset($this->objectRepository[$objectName])) {
            $this->logger->warning('Repository not found for object.', [
                'objectName' => $objectName,
                'repositoryNamespace' => $this->entityRepository
            ]);
            return null;
        }

        return $this->entityRepository->getEntityRepositoryNamespace($objectName);
    }

    public function getEntityAttachmentClass(string $entityClass): ?string
    {
        return $this->entityAttachment->getEntityAttachmentClassName($entityClass);
    }

    public function getEntityTemplatePath(string $route, ?string $action = null): string
    {
        return $this->entityTemplate->getEntityTemplatePath($route, $action);
    }

    public function getEntityObject(?int $id, ?string $slug)
    {
    }

    private function getEntityTypeNamespace(string $entityClass): ?string
    {
        $this->objectByPropsInitializer($entityClass);
        return $this->objectType[$entityClass] ?? null;
    }

    public function getEntityActionName(): ?string
    {
        return $this->entityAction->getEntityCrudActionName();
    }

    public function getEntityLocale(): ?string
    {
        return $this->locale ?? null;
    }

    public function getLocalizedNamespace(string $namespace, string $locale): ?string
    {
        return $this->entityLocalisation->getLocalizedEntityNamespace($namespace, $locale);
    }

    public function getEntityLocalisedNamespace(): ?string
    {
        return $this->entityLocalisation->getLocalizedEntityNamespace(
            $this->getEntityNamespace(),
            $this->getEntityLocale()
        );
    }
    public function getEntityVersioned(string $entity, int $version): ?string
    {
        $versionedNamespace = $this->getEntityNamespace() . $entity . 'V' . $version;

        return class_exists($versionedNamespace) ? $versionedNamespace : null;
    }

}
