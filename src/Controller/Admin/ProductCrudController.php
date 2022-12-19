<?php


namespace App\Controller\Admin;


use App\Entity\Product\Product;
use App\Form\Product\ProductAttachmentType;
use App\Form\Product\ProductType;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('productAttachment')
                ->setEntryType(ProductType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
            ,
            CollectionField::new('productAttachment')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
            ,
//            ImageField::new('firstTitle')
//                ->setBasePath('/upload/product/thumbnail')
//                ->setUploadDir('/upload/product/thumbnail')
//                ->onlyOnIndex()
//            ,
        ];
    }

    use ConfigureFiltersTrait;

}
