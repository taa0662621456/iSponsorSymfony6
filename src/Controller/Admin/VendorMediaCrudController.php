<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\VendorMedia;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VendorMediaCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return VendorMedia::class;
    }

    // ...
}
