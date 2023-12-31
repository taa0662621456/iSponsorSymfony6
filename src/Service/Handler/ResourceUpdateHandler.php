<?php

namespace App\Service\Handler;

use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;

final class ResourceUpdateHandler implements ResourceUpdateHandlerInterface
{
    public function __construct(private readonly ResourceUpdateHandlerInterface $decoratedHandler, private readonly EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws RaceConditionException
     */
    public function handle(
        ResourceInterface $resource,
        RequestConfiguration $requestConfiguration,
        ObjectManager $manager,
    ): void {
        $this->entityManager->beginTransaction();

        try {
            $this->decoratedHandler->handle($resource, $requestConfiguration, $manager);

            $this->entityManager->commit();
        } catch (OptimisticLockException $exception) {
            $this->entityManager->rollback();

            throw new RaceConditionException($exception);
        }
    }
}
