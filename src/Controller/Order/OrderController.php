<?php

namespace App\Controller\Order;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @property $metadata
 */
#[AsController]
class OrderController extends AbstractController
{
    public function save(Request $request): Response
    {
        //        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        //
        //        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        //        $resource = $this->getCurrentCart();
        //
        //        $form = $this->resourceFormFactory->create($configuration, $resource);
        //
        //        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && $form->handleRequest($request)->isSubmitted() && $form->isValid()) {
        //            $resource = $form->getData();
        //
        //            $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::UPDATE, $configuration, $resource);
        //
        //            if ($event->isStopped() && !$configuration->isHtmlRequest()) {
        //                throw new HttpException($event->getErrorCode(), $event->getMessage());
        //            }
        //            if ($event->isStopped()) {
        //                $this->flashHelper->addFlashFromEvent($configuration, $event);
        //
        //                return $this->redirectHandler->redirectToResource($configuration, $resource);
        //            }
        //
        //            if ($configuration->hasStateMachine()) {
        //                $this->stateMachine->apply($configuration, $resource);
        //            }
        //
        //            $this->eventDispatcher->dispatchPostEvent(ResourceActions::UPDATE, $configuration, $resource);
        //
        //            $this->getEventDispatcher()->dispatch(new GenericEvent($resource), SyliusCartEvents::CART_CHANGE);
        //            $this->manager->flush();
        //
        //            if (!$configuration->isHtmlRequest()) {
        //                return $this->viewHandler->handle($configuration, View::create(null, Response::HTTP_NO_CONTENT));
        //            }
        //
        //            $this->flashHelper->addSuccessFlash($configuration, ResourceActions::UPDATE, $resource);
        //
        //            return $this->redirectHandler->redirectToResource($configuration, $resource);
        //        }
        //
        //        if (!$configuration->isHtmlRequest()) {
        //            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        //        }
        //
        $configuration = '';
        $form = '';
        $resource = '';

        return $this->render(
            $configuration->getTemplate(ResourceActions::UPDATE.'.html'),
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

    public function cancel()
    {
    }

    public function requestRefund()
    {
    }

    public function history()
    {
    }
}
