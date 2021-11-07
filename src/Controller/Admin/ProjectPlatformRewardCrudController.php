<?php


namespace App\Controller\Admin;


use App\Repository\Project\ProjectPlatformRewardRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectPlatformRewardCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return ProjectPlatformRewardRepository::class;
    }

    // ...
}
