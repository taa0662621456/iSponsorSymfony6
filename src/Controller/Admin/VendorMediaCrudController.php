<?php

namespace App\Controller\Admin;

use App\Entity\Vendor\VendorMediaAttachment;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VendorMediaCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return VendorMediaAttachment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        //        $thumbnailFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        //        $thumbnail = ImageField::new('thumbnail')->setBasePath('/upload/vendor/image/thumbnail');

        //        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
        //            $fields[] = $thumbnail :
        //            $fields[] = $thumbnailFile;

        return [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),

            TextEditorField::new('last_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),

            AssociationField::new('vendorMediaVendor')->autocomplete()->hideOnIndex(),

            TextField::new('create_By')->hideOnForm(),

            AssociationField::new('vendorMediaAttachment')->hideOnIndex()->autocomplete(),

            CollectionField::new('vendorMediaAttachment')
                ->setEntryType(VendorMediaType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('vendorMediaAttachment')
                ->setTemplatePath('admin/images.html.twig')
                ->onlyOnDetail(),
//            ImageField::new('fileName')
//                ->setBasePath('/upload/vendor/thumbnail')
//                ->setUploadDir('/upload/vendor/thumbnail')
//                ->onlyOnIndex()
//            ,
        ];
    }
}
