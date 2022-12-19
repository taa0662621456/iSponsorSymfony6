<?php

namespace App\Controller\Admin;

use App\Entity\Category\Category;
use App\Form\Category\CategoryAttachmentType;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('categoryAttachment')
                ->setEntryType(CategoryAttachmentType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
            ,
            CollectionField::new('categoryAttachment')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
            ,
            ImageField::new('fileVich')
                ->setBasePath('/upload/category/thumbnail')
                ->setUploadDir('/upload/category/thumbnail')
                ->onlyOnIndex()
            ,
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_EDIT, 'detail');
    }

    use ConfigureFiltersTrait;


}
