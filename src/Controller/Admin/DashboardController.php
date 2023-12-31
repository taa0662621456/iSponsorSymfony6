<?php

namespace App\Controller\Admin;

use App\Entity\Product\ProductReview;
use App\Entity\Project\ProjectReview;
use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Category\Category;
use App\Entity\Product\ProductTag;
use App\Entity\Project\ProjectTag;
use App\Entity\Vendor\VendorMediaAttachment;
use App\Entity\Product\ProductPrice;
use App\Entity\Vendor\VendorDocumentAttachment;
use App\Entity\Product\ProductAttachment;
use App\Entity\Project\ProjectAttachment;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Project\ProjectPlatformReward;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route(path: '/easyadmin', name: 'easyadmin_index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            // Вставьте здесь данные и переменные, которые вы хотите отобразить на дефолтной странице
        ]);
//        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
//        // Option 1. Make your dashboard redirect to the same page for all users
//        return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ISponsor')
            ->setTitle('<img src="#" alt=""> <span class="text-small">iCorp</span>')
            ->setFaviconPath('public/favicon.ico')
            ->setTextDirection('ltr')
            ->renderContentMaximized()
            // ->renderSidebarMinimized()
            ->generateRelativeUrls()
            ->setTranslationDomain('message');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Project');
        yield MenuItem::linkToCrud('Projects', 'fa fa-tags', Project::class);
        yield MenuItem::linkToCrud('PlatformReward', 'fa fa-tags', ProjectPlatformReward::class);
        yield MenuItem::linkToCrud('ProjectMedia', 'fa fa-tags', ProjectAttachment::class);
        yield MenuItem::linkToCrud('ProjectReview', 'fa fa-tags', ProjectReview::class);

        yield MenuItem::section('Product');
        yield MenuItem::linkToCrud('Products', 'fa fa-tags', Product::class);
        yield MenuItem::linkToCrud('ProductMedia', 'fa fa-tags', ProductAttachment::class);
        yield MenuItem::linkToCrud('ProductPrice', 'fa fa-tags', ProductPrice::class);
        yield MenuItem::linkToCrud('ProductReview', 'fa fa-tags', ProductReview::class);

        yield MenuItem::section('User|Vendor');
        yield MenuItem::linkToCrud('Vendors', 'fa fa-tags', Vendor::class);
        yield MenuItem::linkToCrud('VendorMedia', 'fa fa-tags', VendorMediaAttachment::class);
        yield MenuItem::linkToCrud('VendorDocument', 'fa fa-tags', VendorDocumentAttachment::class);

        yield MenuItem::section('Category');
        yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class);
        yield MenuItem::linkToCrud('CategoryMedia', 'fa fa-tags', CategoryAttachment::class);

        yield MenuItem::section('Review');
        yield MenuItem::linkToCrud('ProductReview', 'fa fa-tags', ProductReview::class);
        yield MenuItem::linkToCrud('ProjectReview', 'fa fa-tags', ProjectReview::class);

        yield MenuItem::section('Tags');
        yield MenuItem::linkToCrud('ProjectTags', 'fa fa-tags', ProjectTag::class);
        yield MenuItem::linkToCrud('ProductTags', 'fa fa-tags', ProductTag::class);

        yield MenuItem::section('Events');

        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
        yield MenuItem::linkToExitImpersonation('Stop impersonation', 'fa fa-exit');
    }

    public function configureUserMenu(UserInterface $vendor): UserMenu
    {
        return parent::configureUserMenu($vendor)
            ->setName($vendor->getUserIdentifier());

        //        // use the given $user object to get the user name
        //        ->setName($user->getFullName())
        //        // use this method if you don't want to display the name of the user
        //        ->displayUserName(false)
        //
        //        // you can return an URL with the avatar image
        //        ->setAvatarUrl('https://...')
        //        ->setAvatarUrl($user->getProfileImageUrl())
        //        // use this method if you don't want to display the user image
        //        ->displayUserAvatar(false)
        //        // you can also pass an email address to use gravatar's service
        //        ->setGravatarEmail($user->getMainEmailAddress())
        //
        //        // you can use any type of menu item, except submenus
        //        ->addMenuItems([
        //            MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
        //            MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
        //            MenuItem::section(),
        //            MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
        //        ]);
    }
}
