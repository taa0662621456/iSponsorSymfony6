<?php

namespace App\Controller\Admin;

use App\Entity\Category\CategoryEnGb;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryEnGbCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator->unsetAll();
    }

    public static function getEntityFqcn(): string
    {
        return CategoryEnGb::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
        ];
    }
}
