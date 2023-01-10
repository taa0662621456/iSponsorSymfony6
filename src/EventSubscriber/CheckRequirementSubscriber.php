<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CheckRequirementSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([FormEvents::PRE_SUBMIT => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    public function preSubmit(FormEvent $event): void
    {
        $data = $event->getData();

        if (empty($data) || empty($data['defaultLocale']) || empty($data['baseCurrency'])) {
            return;
        }

        $data['locales'] = $this->resolveLocales(
            $data['locales'] ?? [],
            $data['defaultLocale'],
        )
        ;

        $data['currencies'] = $this->resolveCurrencies(
            $data['currencies'] ?? [],
            $data['baseCurrency'],
        )
        ;

        $event->setData($data);
    }

}
