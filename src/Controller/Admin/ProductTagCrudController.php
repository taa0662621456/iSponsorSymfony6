<?php

namespace App\Controller\Admin;

use App\Entity\Product\ProductTag;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductTagCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return ProductTag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('first_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new('productTagProduct')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),
        ];
    }
}
