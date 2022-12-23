<?php


namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ChannelFormSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([FormEvents::PRE_SUBMIT => "string"])]
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

    /**
     * @param array|string[] $locales
     *
     * @return array|string[]
     */
    private function resolveLocales(array $locales, string $defaultLocale): array
    {
        if (empty($locales)) {
            return [$defaultLocale];
        }

        if (!in_array($defaultLocale, $locales)) {
            $locales[] = $defaultLocale;
        }

        return $locales;
    }

    /**
     * @param array|string[] $currencies
     *
     * @return array|string[]
     */
    private function resolveCurrencies(array $currencies, string $baseCurrency): array
    {
        if (empty($currencies)) {
            return [$baseCurrency];
        }

        if (!in_array($baseCurrency, $currencies)) {
            $currencies[] = $baseCurrency;
        }

        return $currencies;
    }
}
