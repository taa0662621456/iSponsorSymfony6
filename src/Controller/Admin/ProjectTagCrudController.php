<?php


namespace App\Controller\Admin;


use App\Entity\Project\ProjectTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectTag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new('projectTagProject')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),
        ];
    }

    use ConfigureFiltersTrait;
}
