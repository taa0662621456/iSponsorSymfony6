<?php


namespace App\Controller\Admin;


use App\Entity\Category\CategoryAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class CategoryAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryAttachment::class;
    }

    public function configureFields(string $pageName): iterable
    {

        $thumbnailFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $thumbnail = ImageField::new('fileVich')->setBasePath('/upload/category/thumbnail');
        $fields = [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new('categoryAttachmentCategory')->autocomplete(), //TODO: доработать контракт
            TextField::new('create_By')->hideOnForm(),//TODO: доработать контракт

        ];

        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
            $fields[] = $thumbnail :
            $fields[] = $thumbnailFile;

        return $fields;


    }


    use ConfigureFiltersTrait;
}
