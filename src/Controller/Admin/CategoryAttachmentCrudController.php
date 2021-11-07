<?php


namespace App\Controller\Admin;


use App\Entity\Category\CategoryAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryAttachmentCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return CategoryAttachment::class;
    }

    // ...
}
