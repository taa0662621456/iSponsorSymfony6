<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\ProductTag;

class ProductTagCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return ProductTag::class; }

    public function configureActions(Actions $actions): Actions
    {
        $bulkAdd = Action::new('bulkAdd', 'Bulk Add')->linkToCrudAction('bulkAddTags')->setCssClass('btn btn-primary');
        $bulkRemove = Action::new('bulkRemove', 'Bulk Remove')->linkToCrudAction('bulkRemoveTags')->setCssClass('btn btn-danger');
        return $actions->add(Crud::PAGE_INDEX, $bulkAdd)->add(Crud::PAGE_INDEX, $bulkRemove);
    }

    public function bulkAddTags(AdminContext $ctx)
    {
        $this->addFlash('success', 'Tags added');
        return $this->redirect($ctx->getReferrer());
    }

    public function bulkRemoveTags(AdminContext $ctx)
    {
        $this->addFlash('warning', 'Tags removed');
        return $this->redirect($ctx->getReferrer());
    }
}
