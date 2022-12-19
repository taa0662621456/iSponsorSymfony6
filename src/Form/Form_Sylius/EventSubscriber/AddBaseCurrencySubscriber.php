<?php


namespace App\CoreBundle\Form\EventSubscriber;



use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddBaseCurrencySubscriber implements EventSubscriberInterface
{
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
        $form->add('baseCurrency', CurrencyChoiceType::class, [
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
        if ($resource instanceof ChannelInterface) {
            return null !== $resource->getId();
        }

        if (null === $resource) {
            return false;
        }

        throw new UnexpectedTypeException($resource, ChannelInterface::class);
    }
}
