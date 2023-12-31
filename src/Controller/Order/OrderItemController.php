<?php

namespace App\Controller\Order;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class OrderItemController extends AbstractController
{
    public function orderItemAdd(Request $request)
    {
    }

    public function orderItemRemove(Request $request)
    {
    }

    protected function orderItemQuantityIncrease(Request $request)
    {
    }

    protected function orderItemQuantityDecrease(Request $request)
    {
    }
}
