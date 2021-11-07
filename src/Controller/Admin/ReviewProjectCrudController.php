<?php


namespace App\Controller\Admin;


use App\Entity\Review\ReviewProject;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReviewProjectCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return ReviewProject::class;
    }

    // ...
}
