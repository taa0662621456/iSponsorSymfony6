<?php


namespace App\Controller\Admin;


use App\Entity\Project\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
        $thumbnailFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $thumbnail = ImageField::new('fileVich')->setBasePath('/upload/project/image/thumbnail');
        $fields = [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new('projectProduct')->autocomplete()->hideOnIndex(),
            TextField::new('create_By')->hideOnForm(),
            AssociationField::new('projectAttachment')->hideOnIndex()->autocomplete(),
            AssociationField::new('projectTag')->hideOnIndex()->autocomplete(),
            AssociationField::new('projectPlatformReward')->hideOnIndex()->autocomplete(),
        ];

        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
            $fields[] = $thumbnail :
            $fields[] = $thumbnailFile;

        return $fields;
    }

    use ConfigureFiltersTrait;
}
