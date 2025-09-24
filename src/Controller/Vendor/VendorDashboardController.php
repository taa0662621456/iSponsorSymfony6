<?php


namespace App\Controller\Vendor;

use App\Entity\Vendor\VendorSecurity;
use App\Repository\Order\OrderRepository;
use App\Repository\Product\ProductRepository;
use App\Repository\Vendor\VendorMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/vendor/dashboard', name: 'vendor_dashboard')]
#[Route(path: '/sponsor/dashboard', name: 'sponsor_dashboard')]
class VendorDashboardController extends AbstractController
{
    public function __construct(
        private readonly OrderRepository   $orders,
        private readonly ProductRepository $products,
        private readonly VendorMediaRepository $media
    ) {}

    #[Route('/index', name: 'dashboard', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user instanceof VendorSecurity || null === $user->getVendor()) {
            $this->addFlash('warning', 'Нет доступа к панели продавца');
            return $this->redirectToRoute('app_homepage');
        }

        $vendor = $user->getVendor();

        $ordersCount   = $this->safe(fn() => $this->orders->countForVendor($vendor));
        $productsCount = $this->safe(fn() => $this->products->countForVendor($vendor));
        $mediaCount    = $this->safe(fn() => $this->media->countByVendor($vendor));

        $salesTotal    = $this->safe(fn() => $this->orders->sumTotalForVendor($vendor));
        $ordersByStatus = $this->safe(fn() => $this->orders->countByStatus($vendor));
        $latestOrders  = $this->safe(fn() => $this->orders->findLatestForVendor($vendor, 5));

        $response = $this->render('vendor/dashboard.html.twig', [
            'ordersCount'   => $ordersCount,
            'productsCount' => $productsCount,
            'mediaCount'    => $mediaCount,
            'salesTotal'    => $salesTotal,
            'ordersByStatus'=> $ordersByStatus,
            'latestOrders'  => $latestOrders,
        ]);

        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        return $response;
    }

    private function safe(callable $cb, mixed $fallback = 0): mixed
    {
        try {
            return $cb();
        } catch (\Throwable) {
            return $fallback;
        }
    }

}