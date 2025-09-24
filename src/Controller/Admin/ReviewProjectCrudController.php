<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\ReviewProject;

class ReviewProjectCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return ReviewProject::class; }

    public function configureActions(Actions $actions): Actions
    {
        $approve = Action::new('approve', 'Approve')->linkToCrudAction('approveEntity')->setCssClass('btn btn-success');
        $reject = Action::new('reject', 'Reject')->linkToCrudAction('rejectEntity')->setCssClass('btn btn-warning');
        $spam = Action::new('spam', 'Spam')->linkToCrudAction('markSpam')->setCssClass('btn btn-danger');
        return $actions->add(Crud::PAGE_INDEX, $approve)->add(Crud::PAGE_INDEX, $reject)->add(Crud::PAGE_INDEX, $spam);
    }

    public function approveEntity(AdminContext $ctx)
    {
        $e = $ctx->getEntity()->getInstance();
        if (method_exists($e, 'approve')) { $e->approve(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Review approved');
        return $this->redirect($ctx->getReferrer());
    }

    public function rejectEntity(AdminContext $ctx)
    {
        $e = $ctx->getEntity()->getInstance();
        if (method_exists($e, 'reject')) { $e->reject(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('warning', 'Review rejected');
        return $this->redirect($ctx->getReferrer());
    }

    public function markSpam(AdminContext $ctx)
    {
        $e = $ctx->getEntity()->getInstance();
        if (method_exists($e, 'markAsSpam')) { $e->markAsSpam(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('danger', 'Review marked as spam');
        return $this->redirect($ctx->getReferrer());
    }
}