<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\ProjectAttachment;

class ProjectAttachmentCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return ProjectAttachment::class; }

    public function configureActions(Actions $actions): Actions
    {
        $validate = Action::new('validate', 'Validate')->linkToCrudAction('validateAttachment')->setCssClass('btn btn-primary');
        return $actions->add(Crud::PAGE_INDEX, $validate);
    }

    public function validateAttachment(AdminContext $ctx)
    {
        /** @var ProjectAttachment $a */
        $a = $ctx->getEntity()->getInstance();
        $ok = method_exists($a, 'isValid') ? $a->isValid() : true;
        $this->addFlash($ok ? 'success' : 'danger', $ok ? 'Attachment valid' : 'Attachment invalid');
        return $this->redirect($ctx->getReferrer());
    }
}
