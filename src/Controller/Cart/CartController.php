<?php

namespace App\Controller\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CartController extends AbstractController
{
//    #[NoReturn]
//    public function __construct(private readonly ManagerRegistry $managerRegistry)
//    {
//    }
//
//    /**
//     * @throws \JsonException
//     */
//    #[Route(path: 'cart/', name: 'cart_index', methods: ['GET'])]
//	public function index(Request $request) : Response
//	{
//        $managerRegistry = $this->managerRegistry->getManager();
//		$productsRepository = $managerRegistry->getRepository(Product::class);
//		$products = [];
//		$cart = [];
//		$totalSum = 0;
//		$cookies = $request->cookies->all();
//		if (isset($cookies['cart'])) {
//      $cart = json_decode($cookies['cart'], true, 512, JSON_THROW_ON_ERROR);
//  }
//		/**
//		 * @var ProductPrice $productPrice
//		 */
//		foreach ($cart as $productId => $productQuantity) {
//
//      $product = $productsRepository->find((int)$productId);
//      if (is_object($product)) {
//          $productPosition = [];
//          $quantity = abs((int)$productQuantity);
//          $price = $productPrice->getProductPrice();
//          $rowSum = $price * $quantity;
//
//          $productPosition['product'] = $product;
//          $productPosition['quantity'] = $quantity;
//          $productPosition['price'] = $price;
//          $productPosition['sum'] = $rowSum;
//          $totalSum += $rowSum;
//
//          $products[] = $productPosition;
//      }
//  }
//		return $this->render('cart/cart/index.html.twig', [
//            'product' => $products,
//            'total' => $totalSum
//            ]
//        );
//	}
//
//    /**
//    * Show order form.
//    */
//    #[Route(path: 'cart/checkout', name: 'cart_checkout', methods: ['GET', 'POST'])]
//    public function checkout(Request $request, EventDispatcherInterface $eventDispatcher) : array|Response
//    {
//        # TODO: Can't get a way to read the property "vendorId" in class "App\Entity\Order\Order".
//        $order = new OrderStorage();
//        $form = $this->createForm(OrderHistory::class, $order);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//             try {
//                 $orderSuccess = $this->get(ProductUtilite::class)->createOrderDBRecord($request, $order, $this->getUser());
//             }
//             catch (OptimisticLockException | ORMException $e) {
//                 dd($e);
//             }
//
//
//
//             if (!$orderSuccess) {
//                 return $this->redirect($this->generateUrl('cart_empty'));
//             }
//             //TODO: do send email notification
//             $orderSubmitEvent = new OrderSubmitEvent($orderSuccess);
//             $eventDispatcher->dispatch($orderSubmitEvent);
//
//             return $this->render('cart/thankYou.html.twig');
//         }
//                        if (is_object($this->getUser())) {
//             $user = $this->getUser();
//             $this->fillWithUserData($user, $form); //TODO: непонятно, что за параметры
//         }
//                        return [
//                'order' => $order,
//                'form' => $form->createView()
//         ];
//                    }
//
//	#[Route(path: 'cart/empty', name: 'cart_empty', methods: ['GET'])]
//	public function empty() : Response
//	{
//		return $this->render('cart/empty.html.twig');
//	}
//
//    /**
//     * @throws \JsonException
//     */
//    public function navbarCart(Request $request): Response
//	{
//
//        $managerRegistry = $this->managerRegistry->getManager();
//		//quantity -> sum array
//		$cartArray = ['cart' => ['quantity' => 0, 'sum' => 0]];
//		$cookies = $request->cookies->all();
//
//		if (isset($cookies['cart'])) {
//			$cart = json_decode($cookies['cart'], true, 512, JSON_THROW_ON_ERROR);
//			if ($cart === '') {
//				return $this->render('cart/navbarCart.html.twig', [
//					'cart' => $cartArray
//                ]);
//			}
//		} else {
//			return $this->render('cart/empty.html.twig');
//		}
//
//		$productRepository = $managerRegistry->getRepository(Product::class);
//
//		/**
//		 * @var Product $product
//		 */
//		foreach ($cart as $productId => $productQuantity) {
//
//			$product = $productRepository->find((int)$productId);
//			if (is_object($product)) {
//				$cartArray['cart']['sum'] += ($product->getProductPrice() * abs((int)$productQuantity));
//				$cartArray['cart']['quantity'] += abs((int)$productQuantity);
//			}
//		}
//
//		return $this->render('cart/cart/index.html.twig', [
//			'cart' => $cartArray
//		]);
//	}
//
//    private function fillWithUserData(Vendor $user, Form $form): void
//    {
//
//    }
//
//    #[Route(path: 'cart/thank-you', name: 'cart_thank_you', methods: 'GET')]
//    public function thankYou(Request $request): string
//    {
//        return 'Thank You';
//    }
//
//    #[Route(path: 'cart/summery', name: 'cart_summery', methods: 'GET' )]
//    public function summary(Request $request): Response
//    {
//
//            $cart = '';
////        $cart = $this->getCurrentCart();
//        if (null !== $cart->getId()) {
//            $orderRepository = $this->getOrderRepository();
//
//            Assert::isInstanceOf($orderRepository, OrderRepositoryInterface::class);
//
//            $cart = $orderRepository->findCartForSummary($cart->getId());
//        }
//
//        $configuration = '';
//        if (!$configuration->isHtmlRequest()) {
//            return $this->viewHandler->handle($configuration, View::create($cart));
//        }
//
//        $form = '';
//        return $this->render(
//            $configuration->getTemplate('summary.html'),
//            [
//                'cart' => $cart,
//                'form' => $form->createView(),
//            ],
//        );
//    }

}
