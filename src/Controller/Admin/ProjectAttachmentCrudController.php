<?php


namespace App\Controller\Admin;


use App\Entity\Project\ProjectAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectAttachmentCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return ProjectAttachment::class;
    }

    // ...
}
