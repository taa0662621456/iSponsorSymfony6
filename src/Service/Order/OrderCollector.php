<?php

namespace App\Service\Cart;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ServiceInterface\Cart\CartContextServiceInterface;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/**
 * @internal
 */
final class OrderCollector extends DataCollector
{
    public function __construct(private readonly CartContextServiceInterface $cart)
    {
        $this->data = [];
    }

    public function hasCart(): bool
    {
        return [] !== $this->data;
    }

    public function getId(): ?int
    {
        return $this->data['id'];
    }

    public function getTotal(): ?int
    {
        return $this->data['total'];
    }

    public function getSubtotal(): ?int
    {
        return $this->data['subtotal'];
    }

    public function getCurrency(): ?string
    {
        return $this->data['currency'];
    }

    public function getLocale(): ?string
    {
        return $this->data['locale'];
    }

    public function getQuantity(): ?int
    {
        return $this->data['quantity'];
    }

    public function getItems(): ?array
    {
        return $this->data['items'];
    }

    public function getStates(): ?array
    {
        return $this->data['states'];
    }

    public function collect(Request $request, Response $response, \Throwable $exception = null): void
    {
        //        try {
        //            /** @var OrderInterface $cart */
        //            $cart = $this->cart->getCart();
        //
        //            $itemsData = $cart->getItems()->map(static function (OrderItemInterface $item): array {
        //                $variant = $item->getVariant();
        //                $product = $variant->getProduct();
        //
        //                return [
        //                    'id' => $item->getId(),
        //                    'variantName' => $variant->getName(),
        //                    'variantId' => $variant->getId(),
        //                    'variantCode' => $variant->getCode(),
        //                    'quantity' => $item->getQuantity(),
        //                    'productName' => $product->getName(),
        //                    'productCode' => $product->getCode(),
        //                    'productId' => $product->getId(),
        //                ];
        //            })->toArray();
        //
        //            $this->data = [
        //                'id' => $cart->getId(),
        //                'total' => $cart->getTotal(),
        //                'subtotal' => $cart->getItemsTotal(),
        //                'currency' => $cart->getCurrencyCode(),
        //                'locale' => $cart->getLocaleCode(),
        //                'quantity' => count($cart->getItems()),
        //                'items' => $itemsData,
        //                'states' => [
        //                    'main' => $cart->getState(),
        //                    'checkout' => $cart->getCheckoutState(),
        //                    'shipping' => $cart->getShippingState(),
        //                    'payment' => $cart->getPaymentState(),
        //                ],
        //            ];
        //        } catch (CartNotFoundException) {
        //            $this->data = [];
        //        }
    }

    public function reset(): void
    {
        $this->data = [];
    }

    public function getName(): string
    {
        return 'cart';
    }
}
