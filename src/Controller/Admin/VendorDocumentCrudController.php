<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\VendorDocument;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VendorDocumentCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return VendorDocument::class;
    }

    // ...
}
