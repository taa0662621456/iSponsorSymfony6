<?php
namespace App\Controller\Admin\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Dashboard\CustomerStatsService;

class DashboardCustomerStatisticsController extends AbstractController
{
    #[Route('/admin/dashboard/customers', name: 'admin_dashboard_customers')]
    public function customers(CustomerStatsService $service)
    {
        return $this->json(['newCustomers' => $service->getNewCustomersToday()]);
    }
}