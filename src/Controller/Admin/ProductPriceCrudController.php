<?php


namespace App\Controller\Admin;


use App\Entity\Product\ProductPrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductPriceCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return ProductPrice::class;
    }

    // ...
}
