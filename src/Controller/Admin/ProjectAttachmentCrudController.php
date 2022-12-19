<?php


namespace App\Controller\Admin;


use App\Entity\Project\ProductAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductAttachment::class;
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

    use ConfigureFiltersTrait;
}
