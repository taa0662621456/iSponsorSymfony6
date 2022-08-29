<?php


namespace App\Controller\Admin;


use App\Entity\Vendor\VendorDocument;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VendorDocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VendorDocument::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
