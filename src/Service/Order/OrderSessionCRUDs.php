<?php

namespace App\Service\Order;

use App\Entity\Vendor\Vendor;
use App\Entity\Order\OrderItem;
use App\Entity\Product\Product;
use Doctrine\ORM\EntityManager;
use App\Entity\Order\OrderStorage;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if ((!$cart) || !\count($cart)) {
            return false;
        }

        $sum = 0;
        foreach ($cart as $productId => $productQuantity) {
            $product = $productRepository->find((int) $productId);
            if (\is_object($product)) {
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

        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart'], true);

            $cartObj = $cart; // check if cart not empty
            if (!empty($cartObj) && \count((array) $cartObj)) {
                return $cart;
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
        $response->headers->clearCookie('cart');
        $response->sendHeaders();
    }
}
