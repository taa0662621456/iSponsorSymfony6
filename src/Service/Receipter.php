<?php


namespace App\Service;

use App\Entity\Order\Orders;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment as TwigEnvironment;


class Receipter
{
    /**
     * @var \Twig\Environment
     */
    protected TwigEnvironment $twig;
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container, TwigEnvironment $twig)
    {
        $this->container = $container;
        $this->twig = $twig;
    }

    /**
     * @param Orders $order
     * @return array
     */
    public function createReceipt(Orders $order): array
    {
        $receipt = [];
        switch ($order->getOrderPayment()) {
            case 'RoboKassa':
                // TODO: RoboKassa
                break;
            default:// YandexMoney
                //TODO: YandexMoney
                break;
        }
        return $receipt;
    }

}