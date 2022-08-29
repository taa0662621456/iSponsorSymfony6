<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\Vendor;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;


class VendorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vendor::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $thumbnailFile = ImageField::new('thumbnailFile')
            ->setFormType(VichImageType::class)
            ->setUploadDir('/upload/vendor/thumbnailfile')
            ->onlyOnForms()
            ;



        $fields = [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('vendorMedia')
                ->setEntryType(VendorMediaType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
            ,
            CollectionField::new('vendorMedia')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
            ,
            ImageField::new('thumbnail')
                ->setBasePath('/upload/vendor/thumbnail')
                ->setUploadDir('')
                ->onlyOnIndex()
            ,
            AssociationField::new('vendorMedia')->hideOnForm(),
//            AssociationField::new('categoryEnGb')->hideOnIndex()->autocomplete(),
        ];

        return $fields;


    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_EDIT, 'detail');
    }

    use ConfigureFiltersTrait;
}
