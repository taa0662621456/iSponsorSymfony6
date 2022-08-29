<?php


namespace App\Controller\Admin;


use App\Entity\Review\ReviewProject;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReviewProject::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
