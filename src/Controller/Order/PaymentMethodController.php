<?php


namespace App\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodController extends AbstractController
{
    public function getPaymentGatewaysAction(Request $request, string $template): Response
    {
        return $this->render(
            $template,
            [
                'gatewayFactories' => $this->getParameter('gateway_factories'),
                'metadata' => $this->metadata,
            ],
        );
    }
}
