<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\VendorDocument;

class VendorDocumentCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return VendorDocument::class; }

    public function configureActions(Actions $actions): Actions
    {
        $approve = Action::new('approve', 'Approve')->linkToCrudAction('approveDoc')->setCssClass('btn btn-success');
        $reject = Action::new('reject', 'Reject')->linkToCrudAction('rejectDoc')->setCssClass('btn btn-danger');
        return $actions->add(Crud::PAGE_INDEX, $approve)->add(Crud::PAGE_INDEX, $reject);
    }

    public function approveDoc(AdminContext $ctx)
    {
        /** @var VendorDocument $d */
        $d = $ctx->getEntity()->getInstance();
        if (method_exists($d, 'approve')) { $d->approve(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Document approved');
        return $this->redirect($ctx->getReferrer());
    }

    public function rejectDoc(AdminContext $ctx)
    {
        /** @var VendorDocument $d */
        $d = $ctx->getEntity()->getInstance();
        if (method_exists($d, 'reject')) { $d->reject(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('danger', 'Document rejected');
        return $this->redirect($ctx->getReferrer());
    }
}
