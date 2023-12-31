<?php

namespace App\Controller\Admin;

use App\Entity\Project\ProjectReview;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectReview::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('review')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('review')->setNumOfRows(10)->hideOnIndex(),
        ];
    }
}
