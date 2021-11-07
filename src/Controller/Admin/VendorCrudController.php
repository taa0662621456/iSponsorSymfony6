<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VendorCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return Vendor::class;
    }

    // ...
}
