<?php

namespace App\EventSubscriber\Product;

use InvalidArgumentException;
use Webmozart\Assert\Assert;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\EntityInterface\Product\ProductInterface;
use App\EntityInterface\Product\ProductAttributeValueInterface;
use App\ServiceInterface\Locale\LocaleProviderServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @property $attributeValueFactory
 */
final class BuildAttributeFormSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly LocaleProviderServiceInterface $locale,
    ) {
    }

    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string', FormEvents::POST_SUBMIT => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SUBMIT => 'postSubmit',
        ];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        /* @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        $defaultLocaleCode = $this->locale->getDefaultLocaleCode();

        $attributes = $product->getAttributes()->filter(
            fn ($attribute) => $attribute->getLocaleCode() === $defaultLocaleCode,
        );

        /** @var ProductAttributeValueInterface $attribute */
        foreach ($attributes as $attribute) {
            $this->resolveLocalizedAttributes($product, $attribute);
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    public function postSubmit(FormEvent $event): void
    {
        $product = $event->getData();

        /* @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        /** @var ProductAttributeValueInterface $attribute */
        foreach ($product->getAttributes() as $attribute) {
            if (null === $attribute->getValue()) {
                $product->removeAttribute($attribute);
            }
        }
    }

    private function resolveLocalizedAttributes(ProductInterface $product, $attribute): void
    {
        $localeCodes = $this->locale->getLocaleCodes();

        foreach ($localeCodes as $localeCode) {
            if (!$product->hasAttributeByCodeAndLocale($attribute->getCode(), $localeCode)) {
                $attributeValue = $this->createProductAttributeValue($attribute->getAttribute(), $localeCode);
                $product->addAttribute($attributeValue);
            }
        }
    }

    private function createProductAttributeValue(
        $attribute,
        string $localeCode,
    ) {
        $attributeValue = $this->attributeValueFactory->createNew();
        $attributeValue->setAttribute($attribute);
        $attributeValue->setLocaleCode($localeCode);

        return $attributeValue;
    }
}
