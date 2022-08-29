<?php

namespace App\Controller\Admin;

use App\Entity\Category\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;


}
