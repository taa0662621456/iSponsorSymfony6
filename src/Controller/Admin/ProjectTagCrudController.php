<?php

namespace App\Controller\Admin;

use App\Entity\Project\ProjectTag;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectTagCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return ProjectTag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            AssociationField::new('projectTagProject')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),
        ];
    }
}
