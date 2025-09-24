<?php
namespace App\Controller\Admin\Traits;

use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

trait ConfigureCrudDefaultsTrait
{
    protected function configureDefaultFields(): array
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')->hideOnIndex(false)->setSortable(true),
            BooleanField::new('enabled')->renderAsSwitch(false)->hideOnIndex(false),
            DateTimeField::new('createdAt')->onlyOnIndex(),
            DateTimeField::new('updatedAt')->onlyOnIndex(),
        ];
    }

    protected function configureDefaultCrud(Crud $crud): Crud
    {
        return $crud->setSearchFields(['id', 'title', 'slug']);
    }

    protected function configureDefaultFilters(Filters $filters): Filters
    {
        return $filters->add('enabled')->add('createdAt')->add('updatedAt');
    }
}