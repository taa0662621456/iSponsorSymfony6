<?php

namespace App\Controller\Admin;

use App\Entity\Product\ProductReview;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductReview::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('review')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('review')->setNumOfRows(10)->hideOnIndex(),
        ];
    }
}
