<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use App\Controller\Admin\Traits\ConfigureCrudDefaultsTrait;

use App\Entity\Project;

class ProjectCrudController extends BaseCrudController
{
    use ConfigureCrudDefaultsTrait;
    public static function getEntityFqcn(): string { return Project::class; }

    public function configureActions(Actions $actions): Actions
    {
        $publish = Action::new('publish', 'Publish')->linkToCrudAction('publishProject')->setCssClass('btn btn-success');
        $unpublish = Action::new('unpublish', 'Unpublish')->linkToCrudAction('unpublishProject')->setCssClass('btn btn-warning');
        $feature = Action::new('feature', 'Feature')->linkToCrudAction('featureProject')->setCssClass('btn btn-info');

        return $actions->add(Crud::PAGE_INDEX, $publish)->add(Crud::PAGE_INDEX, $unpublish)->add(Crud::PAGE_INDEX, $feature);
    }

    public function publishProject(AdminContext $ctx)
    {
        /** @var Project $p */
        $p = $ctx->getEntity()->getInstance();
        $hasReward = method_exists($p, 'hasReward') ? $p->hasReward() : true;
        $hasTags = method_exists($p, 'hasTags') ? $p->hasTags() : true;
        if (!$hasReward || !$hasTags) {
            $this->addFlash('danger', 'Project requires reward and tags before publishing.');
            return $this->redirect($ctx->getReferrer());
        }
        if (method_exists($p, 'publish')) { $p->publish(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Project published');
        return $this->redirect($ctx->getReferrer());
    }

    public function unpublishProject(AdminContext $ctx)
    {
        /** @var Project $p */
        $p = $ctx->getEntity()->getInstance();
        if (method_exists($p, 'unpublish')) { $p->unpublish(); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('warning', 'Project unpublished');
        return $this->redirect($ctx->getReferrer());
    }

    public function featureProject(AdminContext $ctx)
    {
        /** @var Project $p */
        $p = $ctx->getEntity()->getInstance();
        if (method_exists($p, 'setFeatured')) { $p->setFeatured(true); }
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('info', 'Project featured');
        return $this->redirect($ctx->getReferrer());
    }
}
