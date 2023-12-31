<?php

namespace App\Controller\Admin;

use App\Form\Attachment\AttachmentType;
use App\Entity\Category\CategoryAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryAttachmentCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return CategoryAttachment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('categoryAttachment')
                ->setEntryType(AttachmentType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('categoryAttachment')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail(),
//            ImageField::new('firstTitle')
//                ->setBasePath('/upload/category/thumbnail')
//                ->setUploadDir('/upload/category/thumbnail')
//                ->onlyOnIndex()
//            ,
        ];
    }
}
