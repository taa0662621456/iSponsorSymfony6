<?php

namespace App\Controller\Admin;

use App\Entity\Attachment\Attachment;
use App\Form\Attachment\AttachmentType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attachment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('fileName'),
            IntegerField::new('fileSize'),
            TextField::new('filePath')->setMaxLength(48)->onlyOnIndex(),
            ImageField::new('fileName')
//                ->setFormType(AttachmentType::class)
                ->setBasePath('/upload/category/thumbnail')
                ->setUploadDir('/upload/category/thumbnail')
                ->onlyOnIndex(),
        ];
    }
}
