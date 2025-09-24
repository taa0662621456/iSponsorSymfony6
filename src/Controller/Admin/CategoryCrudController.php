<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\Category;

class CategoryCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return Category::class; }

    public function configureActions(Actions $actions): Actions
    {
        $merge = Action::new('merge', 'Merge')->linkToCrudAction('mergeCategories')->setCssClass('btn btn-secondary');
        return $actions->add(Crud::PAGE_INDEX, $merge);
    }

    public function mergeCategories(AdminContext $ctx)
    {
        $this->addFlash('info', 'Categories merged');
        return $this->redirect($ctx->getReferrer());
    }
}