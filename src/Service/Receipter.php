<?php

namespace App\Service;

use App\Entity\Order\Orders;
use Twig\Environment as TwigEnvironment;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Receipter
{
    protected TwigEnvironment $twig;

    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container, TwigEnvironment $twig)
    {
        $this->container = $container;
        $this->twig = $twig;
    }

    public function createReceipt(Orders $order): array
    {
        $receipt = [];
        switch ($order->getOrderPayment()) {
            case 'RoboKassa':
                // TODO: RoboKassa
                break;
            default:// YandexMoney
                // TODO: YandexMoney
                break;
        }

        return $receipt;
    }
}