<?php
	declare(strict_types=1);

	namespace App\Service;

	use App\Entity\Order\Orders;
	use App\Entity\Order\OrdersItems;
	use App\Entity\Product\Products;
	use App\Entity\Vendor\Vendors;
	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\OptimisticLockException;
	use Doctrine\ORM\ORMException;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;

	class CartCRUDsMethods
	{
		/**
		 * @var EntityManager $em
		 */
		private $em;

		public function __construct(EntityManager $entityManager)
		{
			$this->em = $entityManager;
		}

		/**
		 * Record cart to db orders.
		 *
		 * @param Request      $request
		 * @param Orders       $order
		 * @param Vendors|null $vendor
		 *
		 * @return bool
		 * @throws ORMException
		 * @throws OptimisticLockException
		 */
		public function createOrderDBRecord(Request $request, Orders $order, Vendors $vendor = null): bool
		{
			$productRepository = $this->em->getRepository(Products::class);

			$cart = $this->getCartFromCookies($request);
			if ((!$cart) || !count($cart)) {
				return false;
			}

			$sum = 0;
			foreach ($cart as $productId => $productQuantity) {
				$product = $productRepository->find((int)$productId);
				if (is_object($product)) {
					$quantity = abs((int)$productQuantity);
					$sum += ($quantity * $product->getPrice());

					$orderProduct = new OrdersItems();
					$orderProduct->setOrder($order);
					$orderProduct->setProductId((int)$product);
					$orderProduct->setProductItemPrice($product->getPrice());
					$orderProduct->setProductQuantity($quantity);
					$this->em->persist($orderProduct);

					$order->addOrderItems($orderProduct);
				}
			}

			$order->setCreatedBy($vendor); //can be null if not registered
			$order->setModifiedBy($vendor); //can be null if not registered
			$order->setOrderTotal((string)$sum);
			$this->em->persist($order);
			$this->em->flush();

			$this->clearCart();
			return true;
		}

		/**
		 * @param Request $request
		 *
		 * @return mixed
		 */
		private function getCartFromCookies(Request $request)
		{
			$cookies = $request->cookies->all();

			if (isset($cookies['cart'])) {
				$cart = json_decode($cookies['cart'], true);

				$cartObj = $cart; //check if cart not empty
				if (!empty($cartObj) && count((array)$cartObj)) {
					return $cart;
				}
			}

			return false;
		}

		/**
		 * Clear cookies cart
		 *
		 * @return void
		 */
		public function clearCart(): void
		{
			$response = new Response();
			$response->headers->clearCookie('cart');
			$response->sendHeaders();
		}
	}
