<?php

namespace App\Controller\Admin;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Review\ReviewProduct;
use App\Entity\Review\ReviewProject;
use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorMedia;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="dashboard_index")
     */
    public function index(): Response
    {
        return parent::index();
        //$routeBuilder = $this->get(CrudUrlGenerator::class);

        //return $this->redirect($routeBuilder->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ISponsor')
            ->setTitle('<img src="#"> ACME <span class="text-small">Corp.</span>')
            ->setFaviconPath('favicon.svg')
            ->setTextDirection('ltr')
            # ->renderContentMaximized()
            # ->renderSidebarMinimized()
            # ->disableUrlSignatures()
            # ->generateRelativeUrls()
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Projects');
        yield MenuItem::linkToCrud('Projects', 'fa fa-tags', Project::class);
//        yield MenuItem::section('ProjectAttachments');
        yield MenuItem::linkToCrud('Projects', 'fa fa-tags', ProjectAttachment::class);
//        yield MenuItem::section('Rewards');
        yield MenuItem::linkToCrud('Rewards', 'fa fa-tags', ProjectPlatformReward::class);

        yield MenuItem::section('Product');
        yield MenuItem::linkToCrud('Product', 'fa fa-tags', Product::class);
//        yield MenuItem::section('Price');
        yield MenuItem::linkToCrud('Price', 'fa fa-tags', ProductPrice::class);

        yield MenuItem::section('Users|Vendors');
        yield MenuItem::linkToCrud('Vendors', 'fa fa-tags', Vendor::class);
//        yield MenuItem::section('VendorAttachments');
        yield MenuItem::linkToCrud('VendorDocument', 'fa fa-tags', VendorDocument::class);
        yield MenuItem::linkToCrud('VendorMedia', 'fa fa-tags', VendorMedia::class);

        yield MenuItem::section('Categories');
        yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class);
//        yield MenuItem::section('CategoryAttachments');
        yield MenuItem::linkToCrud('CategoryAttachment', 'fa fa-tags', CategoryAttachment::class);

        yield MenuItem::section('Reviews');
        yield MenuItem::linkToCrud('ProductReviews', 'fa fa-tags', ReviewProduct::class);
        yield MenuItem::linkToCrud('ProjectReviews', 'fa fa-tags', ReviewProject::class);



        yield MenuItem::section('Events');

    }
}
