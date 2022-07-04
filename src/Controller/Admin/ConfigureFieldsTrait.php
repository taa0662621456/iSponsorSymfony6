<?php


namespace App\Controller\Admin;


use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\VichUploaderBundle;

trait ConfigureFieldsTrait
{

    public function configureFields(string $pageName): iterable
    {

        $thumbnailFile = ImageField::new('thumbnailFilePath')->setFormType(VichUploaderBundle::class);
        $thumbnail = ImageField::new('thumbnail')->setBasePath('/upload/product/thumbnail'); //TODO: заменить на определение динамически (использовать наш сервис ДиспетчерЗапросов)
        $fields = [
            TextField::new('title'),
            TextField::new('description'),
            TextField::new('first_title'),
            TextEditorField::new('middle_title'),
            TextField::new('last_title'),
            AssociationField::new('category')->autocomplete(), //TODO: настроить категории
            AssociationField::new('createBy')->hideOnForm()
//            ImageField::new('thumbnailFilePath')->setFormType(VichUploaderBundle::class),
//            ImageField::new('thumbnail')->setBasePath('/upload/product/thumbnail') //TODO: заменить на определение динамически (использовать наш сервис ДиспетчерЗапросов)
//TODO: если использовать универсально для многих проектов, то предыдущая строка не должна указываться явно
// for helping https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqa1l1VExXdFAxeXhlUXowOU0wSmt2UExPTDFtd3xBQ3Jtc0ttR2FhTXBmdFNyWm9mUE9pbFpPR0tiN0VYbXNDRkszSnFCbFVSLWZ6M3NyU3RpaVppck5UZzVuRnNWQ1ZQekVkWEhBRk9kWjBMVmtXekJib3poQkNtcGtTODNQRko0MC15VTVSSXc5TWQ5aUZaSWFBbw&q=https%3A%2F%2Fgithub.com%2Fkonshensx16%2Feasy-admin-3
        ];

        ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) ?
            $fields[] = $thumbnailFile :
            $fields[] = $thumbnail;

        return $fields;


    }

}
