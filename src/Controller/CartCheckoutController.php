<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartCheckoutController extends AbstractController
{
    #[Route(path: 'cart/checkout', name: '', methods: ['GET'])]
    public function checkout()
    {

    }
    #[Route(path: 'cart/address', name: '', methods: ['GET', 'PUT'])]
    public function checkout_address()
    {

    }
    #[Route(path: 'cart/shipping', name: '', methods: ['GET', 'PUT'])]
    public function checkout_shipping()
    {

    }
    #[Route(path: 'cart/payment', name: '', methods: ['GET', 'PUT'])]
    public function checkout_payment()
    {

    }
    #[Route(path: 'cart/complete', name: '', methods: ['GET', 'PUT'])]
    public function checkout_complete()
    {

    }



}
