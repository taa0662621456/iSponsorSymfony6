<?php

namespace App\Controller\Admin;

use App\Entity\Vendor\VendorDocument;
use App\Form\Vendor\VendorDocumentType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VendorDocumentCrudController extends AbstractCrudController
{
    use ConfigureFiltersTrait;

    public static function getEntityFqcn(): string
    {
        return VendorDocument::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('vendorDocumentVendor')
                ->setEntryType(VendorDocumentType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('vendorDocumentVendor')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail(),
//            ImageField::new('fileVich')
//                ->setBasePath('/upload/vendor/thumbnail')
//                ->setUploadDir('/upload/vendor/thumbnail')
//                ->onlyOnIndex()
//            ,
        ];
    }
}
