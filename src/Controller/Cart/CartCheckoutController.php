<?php

namespace App\Controller\Cart;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
class CartCheckoutController extends AbstractController
{
    #[Route(path: 'cart/checkout', name: 'checkout', methods: ['GET'])]
    public function checkout()
    {
    }

    #[Route(path: 'cart/address', name: 'address', methods: ['GET', 'PUT'])]
    public function checkout_address()
    {
    }

    #[Route(path: 'cart/shipping', name: 'shipping', methods: ['GET', 'PUT'])]
    public function checkout_shipping()
    {
    }

    #[Route(path: 'cart/payment', name: 'payment', methods: ['GET', 'PUT'])]
    public function checkout_payment()
    {
    }

    #[Route(path: 'cart/complete', name: 'complete', methods: ['GET', 'PUT'])]
    public function checkout_complete()
    {
    }
}
