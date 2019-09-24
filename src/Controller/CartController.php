<?php
declare(strict_types=1);


namespace App\Controller;


use App\Entity\Order\Orders;
use App\Entity\Product\Products;
use App\Entity\Product\ProductsPrice;
use App\Event\OrderSubmitedEvent;
use App\Form\Order\OrdersType;
use App\Service\ProductsUtilities;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
	/**
	 * @Route("/", name="showcart", methods={"GET"})
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function show(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $productsRepository = $em->getRepository('Products');
        $products = [];
        $cart = [];
        $totalSum = 0;

        $cookies = $request->cookies->all();

        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart'], true);
        }

        /**
         * @var ProductsPrice $productPrice
         */
        foreach ($cart as $productId => $productQuantity) {

            $product = $productsRepository->find((int)$productId);
            if (is_object($product)) {
                $productPosition = [];
                $quantity = abs((int)$productQuantity);
                $price = $productPrice->getProductPrice();
                $rowSum = $price * $quantity;

                $productPosition['product'] = $product;
                $productPosition['quantity'] = $quantity;
                $productPosition['price'] = $price;
                $productPosition['sum'] = $rowSum;
                $totalSum += $rowSum;

                $products[] = $productPosition;
            }
        }

		return $this->render('cart/showCart.html.twig', array(
            'products' => $products,
            'total' => $totalSum
			)
        );
    }

	/**
	 * Shows order form.
	 *
	 * @Route("/orderform", name="orderform", methods={"GET", "POST"})
	 * @param Request                  $request
	 * @param EventDispatcherInterface $eventDispatcher
	 *
	 * @return array|RedirectResponse|Response
	 */
    public function order(Request $request, EventDispatcherInterface $eventDispatcher)
    {
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $orderSuccess = $this->get(ProductsUtilities::class)->createOrderDBRecord($request, $order, $this->getUser());
            } catch (OptimisticLockException $e) {
            } catch (ORMException $e) {
            }
            /*
            if (!$orderSuccess) {
                return $this->redirect($this->generateUrl('cartisempty');
            }
            */

            //send email notification




            $orderSubmitedEvent = new OrderSubmitedEvent($order);
            $eventDispatcher->dispatch($orderSubmitedEvent);

            /*
            $this->get(Mailer::class)->handleNotification([
                'event' => 'new_order',
                'order_id' => $order->getId(),
                'admin_email' => $this->getParameter('app.notifications.email_sender')
            ]);
            */

            return $this->render('cart/thankYou.html.twig');
        }

        if (is_object($user = $this->getUser())) {
            $this->fillWithUserData($user, $form);
        }

        return array(
            'order' => $order,
            'form' => $form->createView()
        );
    }

    /**
     * If cart is empty.
     *
     * @Route("/cartisempty", name="cartisempty", methods={"GET"})
     */
    public function empty(): array
    {
        return [];
    }

	/**
	 * Count cart from cookies
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function navbarCart(Request $request): array
    {

        $em = $this->getDoctrine()->getManager();
        //quantity -> sum array
        $cartArray = ['cart' => ['quantity' => 0, 'sum' => 0]];
        $cookies = $request->cookies->all();

        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart'], true);
            if ($cart === '') {
                return $cartArray;
            }
        } else {
            return $cartArray;
        }

        $productRepository = $em->getRepository(Products::class);

        /**
         * @var Products $product
         */
        foreach ($cart as $productId => $productQuantity) {

            $product = $productRepository->find((int)$productId);
            if (is_object($product)) {
                $cartArray['cart']['sum'] += ($product->getPrice() * abs((int)$productQuantity));
                $cartArray['cart']['quantity'] += abs((int)$productQuantity);
            }
        }

        return $cartArray;
    }

    /**
     * @param Vendors $user
     * @param Form $form
     * @return void
     */
    private function fillWithUserData($user, $form): void
    {

    }
}