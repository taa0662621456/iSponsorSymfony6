<?php


namespace App\Controller\Admin;


use App\Entity\Category\CategoryEnGb;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class CategoryEnGbCrudController extends AbstractCrudController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator->unsetAll();
    }

    public static function getEntityFqcn(): string
    {
        return CategoryEnGb::class;
    }


    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;


}
