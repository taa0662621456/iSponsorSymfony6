<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Entity\Review;

class ReviewCrudController extends BaseCrudController {
    public static function getEntityFqcn(): string {
        return Review::class;
    }

    public function configureActions(Actions $actions): Actions {
        $approve = Action::new('approve', 'Approve')
            ->linkToCrudAction('approveReview');
        $reject = Action::new('reject', 'Reject')
            ->linkToCrudAction('rejectReview');
        $spam = Action::new('spam', 'Mark as Spam')
            ->linkToCrudAction('markSpam');

        return $actions->add(Crud::PAGE_INDEX, $approve)
                       ->add(Crud::PAGE_INDEX, $reject)
                       ->add(Crud::PAGE_INDEX, $spam);
    }

    public function approveReview(AdminContext $context) {
        $review = $context->getEntity()->getInstance();
        $review->approve();
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success', 'Review approved');
        return $this->redirect($context->getReferrer());
    }

    public function rejectReview(AdminContext $context) {
        $review = $context->getEntity()->getInstance();
        $review->reject();
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('warning', 'Review rejected');
        return $this->redirect($context->getReferrer());
    }

    public function markSpam(AdminContext $context) {
        $review = $context->getEntity()->getInstance();
        $review->markAsSpam();
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('danger', 'Review marked as spam');
        return $this->redirect($context->getReferrer());
    }
}
