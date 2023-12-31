<?php

namespace App\Service\Handler;

use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;

final class ResourceDeleteHandler implements ResourceDeleteHandlerInterface
{
    public function __construct(private ResourceDeleteHandlerInterface $decoratedHandler, private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws DeleteHandlingException
     */
    public function handle(ResourceInterface $resource, RepositoryInterface $repository): void
    {
        $this->entityManager->beginTransaction();

        try {
            $this->decoratedHandler->handle($resource, $repository);

            $this->entityManager->commit();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->entityManager->rollback();

            throw new DeleteHandlingException('Cannot delete, the resource is in use.', 'delete_error', 409, 0, $exception);
        } catch (ORMException $exception) {
            $this->entityManager->rollback();

            throw new DeleteHandlingException('Ups, something went wrong during deleting a resource, please try again.', 'something_went_wrong_error', 500, 0, $exception);
        }
    }
}
