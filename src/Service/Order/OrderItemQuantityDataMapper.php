<?php

namespace App\Service\Order;

use App\ServiceInterface\Order\OrderQuantityModifierInterface;
use Symfony\Component\Form\DataMapperInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @internal
 */
class OrderItemQuantityDataMapper implements DataMapperInterface
{
    public function __construct(
        private readonly OrderQuantityModifierInterface $orderItemQuantityModifier,
        private readonly DataMapperInterface $propertyPathDataMapper,
    ) {
    }

    public function mapDataToForms($viewData, $forms): void
    {
        $this->propertyPathDataMapper->mapDataToForms($viewData, $forms);
    }

    public function mapFormsToData($forms, &$viewData): void
    {
        $formsOtherThanQuantity = [];
        foreach ($forms as $form) {
            if ('quantity' === $form->getName()) {
                $targetQuantity = $form->getData();
                $this->orderItemQuantityModifier->modify($viewData, (int) $targetQuantity);

                continue;
            }

            $formsOtherThanQuantity[] = $form;
        }

        if (!empty($formsOtherThanQuantity)) {
            $this->propertyPathDataMapper->mapFormsToData(new ArrayCollection($formsOtherThanQuantity), $viewData);
        }
    }
}
