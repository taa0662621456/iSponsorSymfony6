<?php


namespace App\Controller\Admin;


use App\Entity\Product\ProductAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductAttachment::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
