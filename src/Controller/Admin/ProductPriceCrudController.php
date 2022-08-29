<?php


namespace App\Controller\Admin;


use App\Entity\Product\ProductPrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductPriceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductPrice::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
