<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @property $objectAttachment
 */
class EntityOrchestrator
{
    private const FALLBACK_OBJECT = 'Root';

    public function __construct(
        private readonly EntityPropertyParser $entityPropertyParser,
        private readonly EntityCache          $entityCache,
        private readonly EntityRepository     $entityRepository,
        private readonly EntityLocalisation   $entityLocalisation,
        private readonly EntityType           $entityType,
        private readonly EntityTemplate       $entityTemplate,
        private readonly EntityAttachment     $entityAttachment,
        private readonly EntityRoute          $entityRoute,
        private readonly EntityAction         $entityAction,
        private EntityName                    $entityName,
        private readonly EntityInitializer    $entityInitializer,

        /**
        private string                        $objectLocaleFilter = '',
        private string                        $objectLocale = 'en',
        private readonly string               $objectEntityNamespace = 'App\\Entity\\',
        private readonly string               $repositoryNamespace = 'App\\Repository\\',
        private readonly array                $objectAttachment = [],
        private readonly array                $objectType = [],
        private readonly array                $objectEntity = [],
        private readonly array                $objectRepository = []
         */)
    {

    }

    public function initialize(Request $request): void
    {
        $props = $this->entityPropertyParser->parse($request);
        if ($props) {
            $this->objectConstructor($props);
        }
    }


    private function objectConstructor(ObjectProps $props): void
    {
        $this->entityName = $this->entityName->buildEntityName($props);
    }

    public function objectByPropsInitializer(string $entity, ?string $subEntity = null, ?string $crudAction = 'index'): void
    {
        $props = $this->entityInitializer->initializeObject($entity, $subEntity, $crudAction);

        if (!$props->entity || !$props->crudAction) {
            throw new \InvalidArgumentException('Invalid object initialization properties.');
        }

        $this->objectConstructor($props);
    }

    public function getObjectNamespace(?string $object = self::FALLBACK_OBJECT): string
    {

        $object = ucfirst($object);

        if (!isset($this->objectEntity[$object])) {
            $this->objectByPropsInitializer($object);
        }

        return $this->objectEntity[$object] ?? $this->objectEntityNamespace . self::FALLBACK_OBJECT . 'Entity';

    }

    public function getObjectEntityClass(): string
    {
        return $this->getObjectLocalisedEntityNamespace()
            ?? $this->getObjectNamespace();
    }

    public function getObjectRoutPath(?string $entity = null, ?string $subEntity = null): ?string
    {
        return $this->entityRoute->getRoute();
    }

    public function getObjectRepositoryNamespace(?string $object = null): ?string
    {
        $objectName = $object ?? $this->object;

        if (!isset($this->objectRepository[$objectName])) {
            $this->logger->warning('Repository not found for object.', [
                'objectName' => $objectName,
                'repositoryNamespace' => $this->entityRepository
            ]);
            return null;
        }

        return $this->entityRepository->getRepositoryNamespace($objectName);
    }

    public function getAttachmentClass(string $entityClass): ?string
    {
        return $this->entityAttachment->getAttachmentClass($entityClass);
    }

    public function getTemplatePath(string $route, ?string $action = null): string
    {
        return $this->entityTemplate->getTemplatePath($route, $action);
    }

    private function objectTypeConstructor(string $object): ?string
    {
        $this->objectByPropsInitializer($object);
        return $this->objectType[$object] ?? null;
    }

    public function getObjectCrudActionName(): ?string
    {
        return $this->entityAction->getCrudActionName();
    }

    public function getObjectLocale(): ?string
    {
        return $this->locale ?? null;
    }

    public function getLocaleFilter(): ?string
    {
        return $this->localeFilter ?? null;
    }

    public function getLocalizedNamespace(string $namespace, string $locale): ?string
    {
        return $this->entityLocalisation->getLocalizedEntityNamespace($namespace, $locale);
    }

    public function getObjectLocalisedEntityNamespace(): ?string
    {
        return $this->entityLocalisation->getLocalizedEntityNamespace(
            $this->getObjectNamespace(),
            $this->getObjectLocale()
        );
    }

    private function getRepository(): ?object
    {
        $repository = $this->getObjectRepositoryNamespace();
        if (!$repository || !class_exists($repository)) {
            $this->logger->error('Invalid repository class provided.', ['repository' => $repository]);
            return null;
        }

        return $this->managerRegistry->getRepository($repository);
    }

    public function getObject(?int $id = null, ?string $slug = null): ?object
    {
        $repositoryClass = $this->getObjectRepositoryNamespace();

        if (!$repositoryClass) {
            $this->logger->error('Unable to determine repository class.', [
                'id' => $id,
                'slug' => $slug
            ]);
            throw new \RuntimeException('Repository class cannot be resolved.');
        }

        $repository = $this->managerRegistry->getRepository($repositoryClass);

        $object = $id
            ? $repository->find($id)
            : $repository->findOneBy(['slug' => $slug]);

        if (!$object) {
            $message = sprintf(
                'Object %s not found %s: %s',
                $repositoryClass,
                $id ? 'ID' : 'slug',
                $id ?? $slug
            );
            $this->logger->error($message, ['repository' => $repositoryClass, 'id' => $id, 'slug' => $slug]);
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($message);
        }

        return $object;
    }

    public function clearCache(): void
    {
        $this->entityCache->clear();
    }

}
