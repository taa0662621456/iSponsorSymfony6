<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Dashboard\VendorStatsService;
use App\Service\Dashboard\ProjectStatsService;
use App\Service\Dashboard\CustomerStatsService;
use App\Service\Dashboard\NotificationService;

class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'admin_dashboard')]
    public function index(
        VendorStatsService $vendorStats,
        ProjectStatsService $projectStats,
        CustomerStatsService $customerStats,
        NotificationService $notifications
    ) {
        return $this->render('admin/dashboard/index.html.twig', [
            'activeVendors' => $vendorStats->getActiveVendorsCount(),
            'publishedProjects' => $projectStats->getPublishedProjectsCount(),
            'newCustomers' => $customerStats->getNewCustomersToday(),
            'notifications' => $notifications->getUnreadNotifications(),
        ]);
    }
}
