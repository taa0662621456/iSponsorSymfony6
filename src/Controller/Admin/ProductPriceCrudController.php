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

    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('product_discount_id'),
            TextField::new('override'),
            TextField::new('shopper_group_id'),
            TextField::new('product_price_publish_up'),
            TextField::new('price_quantity_start'),
            TextEditorField::new('product_override_price'),

            TextEditorField::new('product_tax_id'),
        ];


    }

}
