<?php

namespace App\Controller\Admin;

use App\Entity\Project\ProjectAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectAttachmentCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return ProjectAttachment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),

            TextEditorField::new('last_title'),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
        ];
    }
}
