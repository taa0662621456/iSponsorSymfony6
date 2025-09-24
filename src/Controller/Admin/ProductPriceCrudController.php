<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\ProductPrice;

class ProductPriceCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return ProductPrice::class; }

    public function configureActions(Actions $actions): Actions
    {
        $recalc = Action::new('recalculate', 'Recalculate')->linkToCrudAction('recalculatePrices')->setCssClass('btn btn-primary');
        return $actions->add(Crud::PAGE_INDEX, $recalc);
    }

    public function recalculatePrices(AdminContext $ctx)
    {
        $this->addFlash('info', 'Prices recalculated');
        return $this->redirect($ctx->getReferrer());
    }
}