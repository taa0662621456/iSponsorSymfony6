<?php

namespace App\Service\Order\OrderSession;

use App\Entity\Order\OrderItem;
use App\Entity\Order\OrderStorage;
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function is_object;

class OrderSessionCRUDs
{
    private EntityManager $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Record cart to db orders.
     *
     * @throws ORMException
     * @throws OptimisticLockException|\Doctrine\ORM\ORMException
     */
    public function createOrderDBRecord(Request $request, OrderStorage $order, Vendor $vendor = null): bool
    {
        $productRepository = $this->em->getRepository(Product::class);

        $cart = $this->getCartFromCookies($request);
        if ((!$cart) || !count($cart)) {
            return false;
        }

        $sum = 0;
        foreach ($cart as $productId => $productQuantity) {
            $product = $productRepository->find((int) $productId);
            if (is_object($product)) {
                $quantity = abs((int) $productQuantity);
                $sum += ($quantity * $product->getPrice());

                // TODO: methods not found
                $orderProduct = new OrderItem();
                //					$orderProduct->setOrder($order);
                //					$orderProduct->setProductId((int)$product);
                //					$orderProduct->setProductItemPrice($product->getPrice());
                //					$orderProduct->setProductQuantity($quantity);
                $this->em->persist($orderProduct);

                //					$order->addOrderItems($orderProduct);
            }
        }

        $order->setCreatedBy((int) $vendor); // can be null if not registered
        $order->setModifiedBy((int) $vendor); // can be null if not registered
        $order->setOrderTotal((string) $sum);
        $this->em->persist($order);
        $this->em->flush();

        $this->clearCart();

        return true;
    }

    private function getCartFromCookies(Request $request): mixed
    {
        $cookies = $request->cookies->all();

        if (isset($cookies['order'])) {
            $cookiesOrder = json_decode($cookies['order'], true);

            if (!empty($cookiesOrder) && count((array) $cookiesOrder)) {
                return $cookiesOrder;
            }
        }

        return false;
    }

    /**
     * Clear cookies cart.
     */
    public function clearCart(): void
    {
        $response = new Response();
        $response->headers->clearCookie('order');
        $response->sendHeaders();
    }
}