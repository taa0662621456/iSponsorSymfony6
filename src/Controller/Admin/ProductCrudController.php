<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\Product;

class ProductCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return Product::class; }

    public function configureActions(Actions $actions): Actions
    {
        $feature = Action::new('markFeatured', 'Mark as Featured')->linkToCrudAction('markFeaturedProduct')->setCssClass('btn btn-info');
        $export = Action::new('exportPricelist', 'Export Pricelist')->linkToCrudAction('exportPricelist')->setCssClass('btn btn-secondary');
        return $actions->add(Crud::PAGE_INDEX, $feature)->add(Crud::PAGE_INDEX, $export);
    }

    public function markFeaturedProduct(AdminContext $ctx)
    {
        /** @var Product $p */
        $p = $ctx->getEntity()->getInstance();
        if (method_exists($p, 'getPrice') && $p->getPrice() <= 0) {
            $this->addFlash('danger', 'Invalid price');
            return $this->redirect($ctx->getReferrer());
        }
        if (method_exists($p, 'setFeatured')) { $p->setFeatured(true); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Product marked as featured');
        return $this->redirect($ctx->getReferrer());
    }

    public function exportPricelist(AdminContext $ctx)
    {
        $this->addFlash('info', 'Pricelist exported');
        return $this->redirect($ctx->getReferrer());
    }
}
