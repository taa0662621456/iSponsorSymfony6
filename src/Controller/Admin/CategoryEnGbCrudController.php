<?php


namespace App\Controller\Admin;


use App\Entity\Category\CategoryEnGb;

use App\Form\Category\CategoryAttachmentType;
use App\Form\Category\CategoryEnGbType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class CategoryEnGbCrudController extends AbstractCrudController
{
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

    use ConfigureFiltersTrait;


}
