<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Interface\Vendor\VendorInterface;
use App\Exception\UnexpectedTypeException;
use App\Form\Currency\CurrencySelectorType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AddBaseCurrencySubscriber implements EventSubscriberInterface
{
    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $resource = $event->getData();
        $disabled = $this->getDisabledOption($resource);

        $form = $event->getForm();
        $form->add('baseCurrency', CurrencySelectorType::class, [
            'label' => 'form.channel.currency_base',
            'required' => true,
            'disabled' => $disabled,
        ]);
    }

    /**
     * @throws UnexpectedTypeException
     */
    private function getDisabledOption($resource): bool
    {
        if ($resource instanceof VendorInterface) {
            return null !== $resource->getId();
        }

        if (null === $resource) {
            return false;
        }

        throw new UnexpectedTypeException($resource, VendorInterface::class);
    }
}
