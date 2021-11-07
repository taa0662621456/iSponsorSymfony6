<?php
declare(strict_types=1);


namespace App\Controller;


use App\Entity\Order\Order;
use App\Entity\Product\Product;
use App\Entity\Product\ProductPrice;
use App\Entity\Vendor\Vendor;
use App\Event\OrderSubmitEvent;
use App\Form\Order\OrderType;
use App\Service\ProductUtilite;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class CartController extends AbstractController
{

	/**
	 * @Route("cart/", name="cart_index", methods={"GET"})
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
		$productsRepository = $em->getRepository(Product::class);
        $products = [];
        $cart = [];
        $totalSum = 0;

        $cookies = $request->cookies->all();

        if (isset($cookies['cart'])) {
            $cart = json_decode($cookies['cart'], true);
        }

        /**
         * @var ProductPrice $productPrice
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

		return $this->render('cart/cart/index.html.twig', array(
            'product' => $products,
            'total' => $totalSum
			)
        );
    }

	/**
	 * Shows order form.
	 *
	 * @Route("cart/checkout", name="cart_checkout", methods={"GET", "POST"})
	 * @param Request                  $request
	 * @param EventDispatcherInterface $eventDispatcher
	 *
	 * @return array|Response
	 */
    public function checkout(Request $request, EventDispatcherInterface $eventDispatcher): array|Response
    {
        # TODO: Can't get a way to read the property "vendorId" in class "App\Entity\Order\Order".
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $orderSuccess = $this->get(ProductUtilite::class)->createOrderDBRecord($request, $order, $this->getUser());
            }
            catch (OptimisticLockException | ORMException $e) {
                dd($e);
            }



            if (!$orderSuccess) {
                return $this->redirect($this->generateUrl('cart_empty'));
            }
            //TODO: do send email notification
            $orderSubmitEvent = new OrderSubmitEvent($orderSuccess);
            $eventDispatcher->dispatch($orderSubmitEvent);

            return $this->render('cart/thankYou.html.twig');
        }

        if (is_object($this->getUser())) {
            $user = $this->getUser();
            $this->fillWithUserData($user, $form); //TODO: непонятно, что за параметры
        }

        return [
			'order' => $order,
			'form' => $form->createView()
        ];
	}

	/**
	 * @Route("cart/empty", name="cart_empty", methods={"GET"})
	 */
	public function empty(): Response
	{
		return $this->render('cart/empty.html.twig');
	}

	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function navbarCart(Request $request): Response
	{

		$em = $this->getDoctrine()->getManager();
		//quantity -> sum array
		$cartArray = ['cart' => ['quantity' => 0, 'sum' => 0]];
		$cookies = $request->cookies->all();

		if (isset($cookies['cart'])) {
			$cart = json_decode($cookies['cart'], true);
			if ($cart === '') {
				return $this->render('cart/navbarCart.html.twig', array(
					'cart' => $cartArray
				));
			}
		} else {
			return $this->render('cart/empty.html.twig');
		}

		$productRepository = $em->getRepository(Product::class);

		/**
		 * @var Product $product
		 */
		foreach ($cart as $productId => $productQuantity) {

			$product = $productRepository->find((int)$productId);
			if (is_object($product)) {
				$cartArray['cart']['sum'] += ($product->getPrice() * abs((int)$productQuantity));
				$cartArray['cart']['quantity'] += abs((int)$productQuantity);
			}
		}

		return $this->render('cart/cart/index.html.twig', array(
			'cart' => $cartArray
		));
	}

    /**
     * @param Vendor $user
     * @param Form $form
     * @return void
     */
    private function fillWithUserData(Vendor $user, Form $form): void
    {

    }
}
