<?php

namespace App\Service\Entity;

use App\DataTransferObject\ObjectProps;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityManager
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly LoggerInterface $logger,
        private readonly EntityInitializer $entityInitializer,
        private readonly EntityPropertyParser $entityPropertyParser
    )
    {
    }

    public function getEntityObject(int|string|null $id = null, ?string $slug = null): object
    {
        $repositoryClass = $this->getEntityRepositoryNamespace();

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
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpHttpException($message);
        }

        return $object;
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

    public function parseProperties(Request $request): ?ObjectProps
    {
        $entity = $request->attributes->get('entity');
        $subEntity = $request->attributes->get('subEntity');

        if (!$entity) {
            throw new \InvalidArgumentException('Invalid route parameters: entity is missing.');
        }

        return new ObjectProps(
            entity: $entity,
            subEntity: $subEntity
        );
    }
}
