<?php


namespace App\Controller\Admin;


use App\Entity\Project\ProjectAttachment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectAttachmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectAttachment::class;
    }

    use ConfigureCRUDsFieldTrait;
    use ConfigureFiltersTrait;
}
