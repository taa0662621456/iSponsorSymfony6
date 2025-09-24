<?php

namespace App\Controller\Admin;

use App\Entity\Role\RolePermission;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;

class AdministrativeDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Dashboard', 'fa fa-home', 'admin_dashboard');

        yield MenuItem::section('Permissions');
        yield MenuItem::linkToCrud('Permission Matrix', 'fa fa-table', RolePermission::class)
            ->setController(RoleMatrixCrudController::class);
        yield MenuItem::linkToRoute('Permission Matrix', 'fa fa-table', 'admin_permissions_matrix');
        yield MenuItem::linkToRoute('Editable Permission Matrix', 'fa fa-edit', 'admin_permissions_matrix_edit');
        yield MenuItem::linkToRoute('Inline Permission Matrix', 'fa fa-toggle-on', 'admin_permissions_matrix_inline');
        yield MenuItem::linkToCrud('Permission Logs', 'fa fa-history', PermissionChangeLog::class);
        yield MenuItem::linkToRoute('Export XLSX', 'fa fa-file-excel', 'admin_export_permissions_xlsx');

        yield MenuItem::section('Analytics');
        yield MenuItem::linkToRoute('Dashboard Analytics', 'fa fa-chart-line', 'admin_dashboard');
    }
}
