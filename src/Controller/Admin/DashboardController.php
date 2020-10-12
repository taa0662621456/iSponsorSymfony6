<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ISponsor');
    }

    public function configureMenuItems(): iterable
    {
        //TODO: найти альтернативный способ генерации, не зависящий от названий роутов. Например, занести названия роутов в атрибуты (HPH v8) и перенести/вынести в параметры приложения
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Projects', 'fa fa-home', 'project_index');
        yield MenuItem::linktoRoute('Projects', 'fa fa-home', 'review_project_index');
        yield MenuItem::linktoRoute('Products', 'fa fa-home', 'product_index');
        yield MenuItem::linktoRoute('Products', 'fa fa-home', 'review_product_index');
        yield MenuItem::linktoRoute('Vendors', 'fa fa-home', 'vendor_index');
        yield MenuItem::linktoRoute('VenCommissions', 'fa fa-home', 'vendor_commissions_index');
        yield MenuItem::linktoRoute('Attachments', 'fa fa-home', 'attachment_index');
        yield MenuItem::linktoRoute('Events', 'fa fa-home', 'event_index');
        yield MenuItem::linktoRoute('EvCategories', 'fa fa-home', 'event_categories_index');
        yield MenuItem::linktoRoute('EvMembers', 'fa fa-home', 'event_members_index');
    }
}
