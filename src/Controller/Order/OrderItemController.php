<?php

namespace App\Controller\Order;

use App\ControllerSylius\OrderRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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
