<?php

namespace App\Controller\Order;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class OrderShipmentController extends AbstractController
{
    public function getPaymentGatewaysAction(Request $request)
    {
    }
}
