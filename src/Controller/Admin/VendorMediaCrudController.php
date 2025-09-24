<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\VendorMedia;

class VendorMediaCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return VendorMedia::class; }

    public function configureActions(Actions $actions): Actions
    {
        $validate = Action::new('validate', 'Validate')->linkToCrudAction('validateMedia')->setCssClass('btn btn-primary');
        return $actions->add(Crud::PAGE_INDEX, $validate);
    }

    public function validateMedia(AdminContext $ctx)
    {
        /** @var VendorMedia $m */
        $m = $ctx->getEntity()->getInstance();
        $ok = method_exists($m, 'isValid') ? $m->isValid() : true;
        $this->addFlash($ok ? 'success' : 'danger', $ok ? 'Media valid' : 'Media invalid');
        return $this->redirect($ctx->getReferrer());
    }
}