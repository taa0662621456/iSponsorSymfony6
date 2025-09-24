<?php

namespace App\Service\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Controller\SmartCrudController;

final class AdminCrudFacade
{
    public function __construct(private readonly SmartCrudController $crud) {}

    public function delete(string $entityClass, int $id): Response
    {
        return $this->crud->delete($entityClass, $id);
    }

    public function list(string $entityClass, array $criteria = []): Response
    {
        return $this->crud->list($entityClass, $criteria);
    }

    public function update(string $entityClass, int $id, array $data): Response
    {
        return $this->crud->update($entityClass, $id, $data);
    }
}
