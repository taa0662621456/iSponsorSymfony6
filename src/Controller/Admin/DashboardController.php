<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'activeVendors' => $vendorStats->getActiveVendorsCount(),
            'publishedProjects' => $projectStats->getPublishedProjectsCount(),
            'newCustomers' => $customerStats->getNewCustomersToday(),
            'notifications' => $notifications->getUnreadNotifications(),
            'customersPerDay' => $customerStats->getNewCustomersPerDay(7),
            'projectsPerDay'    => $projectStats->getPublishedProjectsPerDay(7)
        ]);
    }

    #[Route('/admin/stats/projects/{days}', name: 'admin_stats_projects', requirements: ['days' => '\d+'], defaults: ['days' => 7])]
    public function projectsStats(ProjectStatsService $projectStats, int $days): JsonResponse
    {
        return new JsonResponse($projectStats->getPublishedProjectsPerDay($days));
    }

    #[Route('/admin/stats/combined/{days}', name: 'admin_stats_combined', requirements: ['days' => '\d+'], defaults: ['days' => 7])]
    public function combinedStats(
        CustomerStatsService $customerStats,
        ProjectStatsService $projectStats,
        int $days
    ): JsonResponse {
        $customers = $customerStats->getNewCustomersPerDay($days);
        $projects = $projectStats->getPublishedProjectsPerDay($days);

        // приводим к единому формату (date → counts)
        $result = [];
        foreach ($customers as $c) {
            $result[$c['date']]['customers'] = $c['count'];
            $result[$c['date']]['date'] = $c['date'];
        }
        foreach ($projects as $p) {
            $result[$p['date']]['projects'] = $p['count'];
            $result[$p['date']]['date'] = $p['date'];
        }

        // заполняем пустые значения нулями
        foreach ($result as &$row) {
            $row['customers'] = $row['customers'] ?? 0;
            $row['projects']  = $row['projects'] ?? 0;
        }

        // сортируем по дате
        usort($result, fn($a, $b) => strcmp($a['date'], $b['date']));

        return new JsonResponse($result);
    }


    #[Route('/admin/stats/customers/{days}', name: 'admin_stats_customers', requirements: ['days' => '\d+'], defaults: ['days' => 7])]
    public function customersStats(CustomerStatsService $customerStats, int $days): JsonResponse
    {
        return new JsonResponse($customerStats->getNewCustomersPerDay($days));
    }

}
