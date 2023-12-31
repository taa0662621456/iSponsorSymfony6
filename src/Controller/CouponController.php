<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Interface\PromotionCouponGeneratorInterface;
use App\Form\PromotionCouponGeneratorInstructionType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CouponController
{
    /**
     * @throws NotFoundHttpException
     */
    public function generateAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        if (null === $promotionId = $request->attributes->get('promotionId')) {
            throw new NotFoundHttpException('No promotion id given.');
        }

        if (null === $promotion = $this->getApplication->get('repository.promotion')->find($promotionId)) {
            throw new NotFoundHttpException('Promotion not found.');
        }

        $form = $this->container->get('form.factory')->create(PromotionCouponGeneratorInstructionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getGenerator()->generate($promotion, $form->getData());
            $this->flashHelper->addSuccessFlash($configuration, 'generate');

            return $this->redirectHandler->redirectToResource($configuration, $promotion);
        }

        //        if (!$configuration->isHtmlRequest()) {
        //            return $this->viewHandler->handle($configuration, View::create($form));
        //        }

        return $this->render(
            $configuration->getTemplate('generate.html'),
            [
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'promotion' => $promotion,
                'form' => $form->createView(),
            ],
        );
    }

    protected function getGenerator(): PromotionCouponGeneratorInterface
    {
        return $this->container->get('coupon_generator');
    }
}
