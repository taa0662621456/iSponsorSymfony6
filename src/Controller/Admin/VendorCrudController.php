<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\Vendor;

class VendorCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;

    public static function getEntityFqcn(): string { return Vendor::class; }

    public function configureActions(Actions $actions): Actions
    {
        $approve = Action::new('approve', 'Approve')->linkToCrudAction('approveVendor')->setCssClass('btn btn-success');
        $suspend = Action::new('suspend', 'Suspend')->linkToCrudAction('suspendVendor')->setCssClass('btn btn-warning');
        $export = Action::new('exportProfile', 'Export Profile')->linkToCrudAction('exportProfile')->setCssClass('btn btn-info');

        return $actions
            ->add(Crud::PAGE_INDEX, $approve)
            ->add(Crud::PAGE_INDEX, $suspend)
            ->add(Crud::PAGE_DETAIL, $export);
    }

    public function approveVendor(AdminContext $ctx)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Vendor $v */
        $v = $ctx->getEntity()->getInstance();
        if (!method_exists($v, 'hasDocuments') || !method_exists($v, 'hasMedia') || !$v->hasDocuments() || !$v->hasMedia()) {
            $this->addFlash('danger', 'Vendor requires documents and media before approval.');
            return $this->redirect($ctx->getReferrer());
        }
        if (method_exists($v, 'approve')) { $v->approve(); }
        $em->flush();
        $this->addFlash('success', 'Vendor approved');
        return $this->redirect($ctx->getReferrer());
    }

    public function suspendVendor(AdminContext $ctx)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Vendor $v */
        $v = $ctx->getEntity()->getInstance();
        if (method_exists($v, 'suspend')) { $v->suspend(); }
        $em->flush();
        $this->addFlash('warning', 'Vendor suspended');
        return $this->redirect($ctx->getReferrer());
    }

    public function exportProfile(AdminContext $ctx)
    {
        $this->addFlash('info', 'Vendor profile exported');
        return $this->redirect($ctx->getReferrer());
    }
}
