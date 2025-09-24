<?php
/**
 * https://symfony.com/bundles/EasyAdminBundle/4.x/filters.html.
 */

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

trait ConfigureFiltersTrait
{
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('firstTitle')
            ->add('middleTitle')
            ->add('lastTitle')
            ->add('published');
    }
}