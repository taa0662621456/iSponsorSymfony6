<?php


namespace App\Controller\Admin;


use App\Entity\Review\ProductReview;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewProductCrudController extends AbstractCrudController
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
