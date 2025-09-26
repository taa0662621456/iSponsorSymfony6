<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\ProjectPlatformReward;

class ProjectPlatformRewardCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return ProjectPlatformReward::class; }

    public function configureActions(Actions $actions): Actions
    {
        $validate = Action::new('validate', 'Validate')->linkToCrudAction('validateReward')->setCssClass('btn btn-primary');
        return $actions->add(Crud::PAGE_INDEX, $validate);
    }

    public function validateReward(AdminContext $ctx)
    {
        /** @var ProjectPlatformReward $r */
        $r = $ctx->getEntity()->getInstance();
        $ok = method_exists($r, 'isValid') ? $r->isValid() : true;
        $this->addFlash($ok ? 'success' : 'danger', $ok ? 'Reward valid' : 'Reward invalid');
        return $this->redirect($ctx->getReferrer());
    }
}
