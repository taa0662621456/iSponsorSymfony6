<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\Vendor;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class VendorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vendor::class;
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

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_EDIT, 'detail');
    }

    use ConfigureFiltersTrait;
}
