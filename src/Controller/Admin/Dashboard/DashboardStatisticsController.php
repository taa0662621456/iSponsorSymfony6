<?php
namespace App\Controller\Admin\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Dashboard\VendorStatsService;
use App\Service\Dashboard\ProjectStatsService;

class DashboardStatisticsController extends AbstractController
{
    #[Route('/admin/dashboard/stats', name: 'admin_dashboard_stats')]
    public function stats(VendorStatsService $vendor, ProjectStatsService $project)
    {
        return $this->json([
            'activeVendors' => $vendor->getActiveVendorsCount(),
            'publishedProjects' => $project->getPublishedProjectsCount(),
        ]);
    }
}
