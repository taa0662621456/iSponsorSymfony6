<?php
/**
 * https://symfony.com/bundles/EasyAdminBundle/4.x/fields.html
 * там же и пример дизайна
 * там же и типы полей
 * там же и дополнительные панели
 */

namespace App\Controller\Admin;


use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

trait ConfigureCRUDsFieldTrait
{

    public function configureFields(string $pageName): iterable
    {
        #
        $objectFqcn = $this->getEntityFqcn();
        $object = explode('\\', $objectFqcn);
        $object2 = $object[count($object) -2];

        $objectAssociationField = explode('\\', $objectFqcn);
        $objectAssociationField = end($object);
        $objectAssociationField = str_replace('CrudController', '', $objectAssociationField, ) . $object2;
        $object = strtolower($object2);
        $objectAssociationField = lcfirst($objectAssociationField);
        #
//        dd($objectAssociationField);

        $thumbnailFile = ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $thumbnail = ImageField::new('fileVich')->setBasePath('/upload/'. $object .'/image/thumbnail');

        $fields = [
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title')->setMaxLength(48)->onlyOnIndex(),
            TextEditorField::new('last_title')->setNumOfRows(10)->hideOnIndex(),
            AssociationField::new($objectAssociationField)->autocomplete(), //TODO: доработать контракт
            TextField::new('create_By')->hideOnForm(),//TODO: доработать контракт
//            AssociationField::new('categoryEnGb')->hideOnIndex()->autocomplete(),
        ];

        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
            $fields[] = $thumbnail :
            $fields[] = $thumbnailFile;

        return $fields;


    }

}
