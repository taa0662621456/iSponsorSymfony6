<?php


namespace App\Controller\Admin;


use App\Entity\Review\ReviewProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReviewProductCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return ReviewProduct::class;
    }

    // ...
}
