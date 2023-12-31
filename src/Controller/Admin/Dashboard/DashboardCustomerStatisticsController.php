<?php

namespace App\Controller\Admin\Dashboard;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class DashboardCustomerStatisticsController
{
    public function __construct(
        private $statisticsProvider,
        private $customerRepository,
        private readonly Environment $templatingEngine,
    ) {
    }

    /**
     * @throws HttpException
     */
    public function renderAction(Request $request): Response
    {
        $customerId = $request->query->get('customerId');

        /** @var null $customer */
        $customer = $this->customerRepository->find($customerId);
        if (null === $customer) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, sprintf('Customer with id %s doesn\'t exist.', (string) $customerId));
        }

        $customerStatistics = $this->statisticsProvider->getCustomerStatistics($customer);

        return new Response($this->templatingEngine->render(
            'dashboard/dashboard_customer_statistic.html.twig',
            ['statistics' => $customerStatistics],
        ));
    }
}
