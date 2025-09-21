<?php

namespace App\Controller\Admin\Dashboard;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class DashboardCustomerStatisticsController
{
    public function __construct(
        private $statisticsProvider,
        private $customerRepository,
        private readonly Environment $templatingEngine,
    ) {
    }

    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderAction(Request $request): Response
    {
        $customerId = $request->query->get('customerId');

        /** @var null $customer */
        $customer = $this->customerRepository->find($customerId);
        if (null === $customer) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, sprintf('Customer with id %s does n\'t exist.', $customerId));
        }

        $customerStatistics = $this->statisticsProvider->getCustomerStatistics($customer);

        try {
            return new Response($this->templatingEngine->render(
                'dashboard/dashboard_customer_statistic.html.twig',
                ['statistics' => $customerStatistics],
            ));
        } catch (LoaderError|SyntaxError|RuntimeError $e) {
        }
    }
}
