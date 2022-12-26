<?php


namespace App\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class OrderPaymentController extends AbstractController
{
    public function getPaymentGatewaysAction(Request $request)
    {

    }
}
