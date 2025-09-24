<?php
namespace App\Controller\Admin\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Dashboard\NotificationService;

class DashboardNotificationController extends AbstractController
{
    #[Route('/admin/dashboard/notifications', name: 'admin_dashboard_notifications')]
    public function notifications(NotificationService $service)
    {
        return $this->json($service->getUnreadNotifications());
    }
}