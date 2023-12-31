<?php

namespace App\Controller\Admin\Dashboard;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;
use Symfony\Component\HttpFoundation\Response;

final class DashboardStatisticsController
{
    public function __construct(
        private readonly Environment $templatingEngine,
        private $statisticsDataProvider,
    ) {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function renderStatistics($channel): Response
    {
        return new Response($this->templatingEngine->render(
            'dashboard/dashboard.html.twig',
            $this->statisticsDataProvider->getRawData(
                $channel,
                (new \DateTime('first day of january this year')),
                (new \DateTime('first day of january next year')),
                'month',
            ),
        ));
    }
}
