<?php

namespace App\Controller\Order;

use App\ControllerSylius\OrderRepositoryInterface;
use App\Interface\CartContextInterface;
use App\OrderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends AbstractController
{
    public function summary(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $cart = $this->getCurrentCart();
        if (null !== $cart->getId()) {
            $cart = $this->getOrderRepository()->findCartById($cart->getId());
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($cart));
        }

        $form = $this->resourceFormFactory->create($configuration, $cart);

        return $this->render(
            $configuration->getTemplate('summary.html'),
            [
                'cart' => $cart,
                'form' => $form->createView(),
            ],
        );
    }

    public function widget(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $cart = $this->getCurrentCart();

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($cart));
        }

        return $this->render(
            $configuration->getTemplate('summary.html'),
            [
                'cart' => $cart,
            ],
        );
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

    /**
     * @psalm-suppress DeprecatedMethod
     */
    public function clear(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::DELETE);
        $resource = $this->getCurrentCart();

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid((string) $resource->getId(), $this->getParameterFromRequest($request))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::DELETE, $configuration, $resource);

        if ($event->isStopped() && !$configuration->isHtmlRequest()) {
            throw new HttpException($event->getErrorCode(), $event->getMessage());
        }
        if ($event->isStopped()) {
            $this->flashHelper->addFlashFromEvent($configuration, $event);

            return $this->redirectHandler->redirectToIndex($configuration, $resource);
        }

        $this->repository->remove($resource);
        $this->eventDispatcher->dispatchPostEvent(ResourceActions::DELETE, $configuration, $resource);

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
        }

        $this->flashHelper->addSuccessFlash($configuration, ResourceActions::DELETE, $resource);

        return $this->redirectHandler->redirectToIndex($configuration, $resource);
    }

//    protected function redirectToCartSummary(RequestConfiguration $configuration): Response
//    {
//        if (null === $configuration->getParameters()->get('redirect')) {
//            return $this->redirectHandler->redirectToRoute($configuration, $this->getCartSummaryRoute());
//        }
//
//        return $this->redirectHandler->redirectToRoute($configuration, $configuration->getParameters()->get('redirect'));
//    }

    protected function getCartSummaryRoute(): string
    {
        return 'sylius_cart_summary';
    }

    protected function getCurrentCart(): OrderInterface
    {
        return $this->getContext()->getCart();
    }

    protected function getContext(): CartContextInterface
    {
        return $this->get('context.cart');
    }

    protected function getOrderRepository(): OrderRepositoryInterface
    {
        return $this->get('repository.order');
    }


}
