<?php


namespace App\Controller\Admin;


use App\Entity\Project\ProjectPlatformReward;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectPlatformRewardCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectPlatformReward::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('commission_start_time'),
            TextEditorField::new('commission_end_time'),
            AssociationField::new('projectPlatformRewardProject')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),

        ];
    }
}
