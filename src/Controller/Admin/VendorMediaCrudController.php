<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\VendorMedia;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\VichUploaderBundle;

class VendorMediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VendorMedia::class;
    }

    public function configureFields(string $pageName): iterable
    {


        $thumbnailFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $thumbnail = ImageField::new('thumbnail')->setBasePath('/upload/vendor/image/thumbnail');

        $fields = [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new('vendorMedia')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),
            AssociationField::new('vendorDocument')->hideOnIndex()->autocomplete(),
        ];

        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
            $fields[] = $thumbnail :
            $fields[] = $thumbnailFile;

        return $fields;
    }


    use ConfigureFiltersTrait;



}
