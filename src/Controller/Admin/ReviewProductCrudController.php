<?php


namespace App\Controller\Admin;


use App\Entity\Review\ReviewProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReviewProduct::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
