<?php

namespace App\Controller\Order;

use App\Entity\Order\OrderStorage;
use App\Interface\Cart\CartContextInterface;
use App\Interface\Order\OrderInterface;
use App\Interface\Order\OrderRepositoryInterface;
use App\Service\OrderServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/order', name: 'order_')]
class OrderController extends AbstractController
{
    public function __construct(
        private readonly OrderServiceInterface    $order,
        private readonly OrderRefundServiceInterface   $refund,
        private readonly LoggerInterface $logger
    ) {}

    #[Route('/{id}', name: 'view', methods: ['GET'])]
    public function view(OrderStorage $order): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_VIEW', $order);
        return $this->json($this->order->dto($order), 200, ['Cache-Control' => 'no-store']);
    }

    #[Route('/{id}/cancel', name: 'cancel', methods: ['POST'])]
    public function cancel(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_CANCEL', $order);
        $this->assertCsrf('order_cancel_'.$order->getId(), $r->request->get('_token'));

        $this->order->cancel($order, by: $this->getUser());
        $this->logger->info('order:cancel', ['order' => $order->getId(), 'user' => $this->getUser()?->getUserIdentifier()]);
        return $this->json(['status' => 'CANCELLED']);
    }

    #[Route('/{id}/refund', name: 'refund', methods: ['POST'])]
    public function refund(OrderStorage $order, Request $r): JsonResponse
    {
        $this->denyAccessUnlessGranted('ORDER_REFUND', $order);
        $this->assertCsrf('order_refund_'.$order->getId(), $r->request->get('_token'));

        $items = $r->request->all('items'); // [{itemId, qty, amountCents}]
        $result = $this->refund->startRefund($order, $items, by: $this->getUser());
        return $this->json($result, 202);
    }

    private function assertCsrf(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
    }


    public function save(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        $resource = $this->getCurrentCart();

        $form = $this->resourceFormFactory->create($configuration, $resource);

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && $form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $resource = $form->getData();

            $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::UPDATE, $configuration, $resource);

            if ($event->isStopped() && !$configuration->isHtmlRequest()) {
                throw new HttpException($event->getErrorCode(), $event->getMessage());
            }
            if ($event->isStopped()) {
                $this->flashHelper->addFlashFromEvent($configuration, $event);

                return $this->redirectHandler->redirectToResource($configuration, $resource);
            }

            if ($configuration->hasStateMachine()) {
                $this->stateMachine->apply($configuration, $resource);
            }

            $this->eventDispatcher->dispatchPostEvent(ResourceActions::UPDATE, $configuration, $resource);

            $this->getEventDispatcher()->dispatch(new GenericEvent($resource), SyliusCartEvents::CART_CHANGE);
            $this->manager->flush();

            if (!$configuration->isHtmlRequest()) {
                return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
            }

            $this->flashHelper->addSuccessFlash($configuration, ResourceActions::UPDATE, $resource);

            return $this->redirectHandler->redirectToResource($configuration, $resource);
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        }

        return $this->render(
            $configuration->getTemplate(ResourceActions::UPDATE . '.html'),
            [
                'configuration' => $configuration,
                $this->metadata->getName() => $resource,
                'form' => $form->createView(),
                'cart' => $resource,
            ],
        );
    }


    protected function getCartSummaryRoute(): string
    {
        return 'sylius_cart_summary';
    }


    public function update()
    {

    }

    public function requestRefund()
    {

    }

    public function history()
    {

    }


}
