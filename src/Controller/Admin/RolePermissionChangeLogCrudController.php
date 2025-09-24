<?php

namespace App\Controller\Admin;

use App\Entity\Security\PermissionChangeLog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class RolePermissionChangeLogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PermissionChangeLog::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Permission Logs')
            ->setEntityLabelInSingular('Permission Log')
            ->setDefaultSort(['changedAt' => 'DESC'])
            ->showExportButton(); // 👈 включает кнопку "Export"
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::EXPORT); // 👈 добавляем действие экспорта
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('role'),
            ChoiceField::new('permission')->setChoices([
                'View'   => 'VIEW',
                'Edit'   => 'EDIT',
                'Delete' => 'DELETE',
                'Cancel' => 'CANCEL',
                'Refund' => 'REFUND',
                'Pay'    => 'PAY',
            ])->renderAsBadges(),
            ChoiceField::new('action')->setChoices([
                'Grant'  => 'grant',
                'Revoke' => 'revoke',
            ])->renderAsBadges(),
            TextField::new('changedBy'),
            DateTimeField::new('changedAt'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('role'))
            ->add(ChoiceFilter::new('permission')->setChoices([
                'View'   => 'VIEW',
                'Edit'   => 'EDIT',
                'Delete' => 'DELETE',
                'Cancel' => 'CANCEL',
                'Refund' => 'REFUND',
                'Pay'    => 'PAY',
            ]))
            ->add(ChoiceFilter::new('action')->setChoices([
                'Grant'  => 'grant',
                'Revoke' => 'revoke',
            ]))
            ->add(TextFilter::new('changedBy'))
            ->add(DateTimeFilter::new('changedAt'));
    }
}
