<?php


namespace App\Controller\Admin;


use App\Entity\Project\Project;
use App\Form\Project\ProjectAttachmentType;
use App\Form\Vendor\VendorMediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('firstTitle'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            CollectionField::new('projectAttachment')
                ->setEntryType(ProjectAttachmentType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms()
            ,
            CollectionField::new('projectAttachment')
                ->setTemplatePath('images.html.twig')
                ->onlyOnDetail()
            ,
//            ImageField::new('firstTitle')
//                ->setBasePath('/upload/project/thumbnail')
//                ->setUploadDir('/upload/project/thumbnail')
//                ->onlyOnIndex()
//            ,
        ];
    }

    use ConfigureFiltersTrait;
}
